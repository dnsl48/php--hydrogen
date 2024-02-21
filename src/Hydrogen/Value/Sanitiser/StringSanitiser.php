<?php declare(strict_types = 1);

namespace Hydrogen\Value\Sanitiser;

use Hydrogen\Exception\DataSanitisationException;
use Override;
use Stringable;

/**
 * @extends AbstractSanitiser<Stringable|scalar|null, string>
 *
 * @api
 */
class StringSanitiser extends AbstractSanitiser
{
    /**
     * Return the boolean value
     *
     * @throws DataSanitisationException<Stringable|scalar|null> when cannot cast the value losslessly
     */
    #[Override]
    public function sanitise(): string
    {
        return self::sanitiseValue($this->value);
    }

    /**
     * @phpstan-pure
     *
     * @param Stringable|scalar|null $value
     *
     * @throws DataSanitisationException<Stringable|scalar|null> when cannot cast the value losslessly
     */
    public static function sanitiseValue($value): string
    {
        if (null === $value) {
            return '';
        }

        if ($value instanceof Stringable) {
            return (string) $value;
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        throw new DataSanitisationException(
            $value,
            'Cannot cast a non-scalar non-stringable value to string',
        );
    }
}
