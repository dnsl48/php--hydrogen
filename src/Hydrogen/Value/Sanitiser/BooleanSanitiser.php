<?php declare(strict_types = 1);

namespace Hydrogen\Value\Sanitiser;

use Hydrogen\Exception\DataSanitisationException;
use Override;

/**
 * @extends AbstractSanitiser<?scalar, bool>
 *
 * @api
 */
class BooleanSanitiser extends AbstractSanitiser
{
    /**
     * Return the boolean value
     *
     * @throws DataSanitisationException<?scalar> when cannot cast the value losslessly
     */
    #[Override]
    public function sanitise(): bool
    {
        return self::sanitiseValue($this->value);
    }

    /**
     * @phpstan-pure
     *
     * @param ?scalar $value
     *
     * @throws DataSanitisationException<?scalar> when cannot cast the value losslessly
     */
    public static function sanitiseValue($value): bool
    {
        return match ($value) {
            null, false, 0, '0', '' => false,
            true, 1, '1' => true,
            default => throw new DataSanitisationException(
                $value,
                'Could not read the boolean value. Only bool, null, "", 1 or 0 are accepted.',
            )
        };
    }
}
