<?php

namespace App\Services;

class LeadValidationService
{
    /**
     * Validate an email address with offline syntax check and online DNS/MX verification
     */
    public function validateEmail(string $email, bool $checkDns = true): array
    {
        $email = strtolower(trim($email));
        $syntaxValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        
        $disposableDomains = [
            'mailinator.com', 'tempmail.com', 'guerrillamail.com', '10minutemail.com',
            'trashmail.com', 'sharklasers.com', 'yopmail.com', 'dispostable.com',
        ];

        $domain = substr(strrchr($email, '@'), 1);
        $isDisposable = in_array($domain, $disposableDomains);

        $hasMx = false;
        if ($syntaxValid && $checkDns && !empty($domain)) {
            // DNS check for MX or A records
            $hasMx = checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A');
        }

        return [
            'type'            => 'email',
            'value'           => $email,
            'normalized'      => $email,
            'is_syntax_valid' => $syntaxValid,
            'is_disposable'   => $isDisposable,
            'has_mx_records'  => $hasMx,
            'overall_valid'   => $syntaxValid && !$isDisposable && (!$checkDns || $hasMx),
        ];
    }

    /**
     * Validate and normalize a phone number (E.164 format check)
     */
    public function validatePhone(string $phone, string $defaultCountry = 'IN'): array
    {
        $raw = trim($phone);
        // Strip non-digit characters except leading plus
        $clean = preg_replace('/[^\d+]/', '', $raw);

        // Auto prepend country code if missing
        if (!str_starts_with($clean, '+')) {
            if (strlen($clean) === 10 && $defaultCountry === 'IN') {
                $clean = '+91' . $clean;
            } elseif (strlen($clean) === 11 && str_starts_with($clean, '0') && $defaultCountry === 'IN') {
                $clean = '+91' . substr($clean, 1);
            } else {
                $clean = '+' . $clean;
            }
        }

        // Standard E.164 is + followed by 8 to 15 digits
        $isE164Valid = (bool) preg_match('/^\+[1-9]\d{7,14}$/', $clean);

        // Detect country code & line type guess
        $countryCode = 'UNKNOWN';
        $lineType = 'general';

        if (str_starts_with($clean, '+91')) {
            $countryCode = 'IN';
            $subscriberDigits = substr($clean, 3);
            if (preg_match('/^[6-9]\d{9}$/', $subscriberDigits)) {
                $lineType = 'mobile';
            } else {
                $lineType = 'landline';
            }
        } elseif (str_starts_with($clean, '+1')) {
            $countryCode = 'US';
            $lineType = 'general';
        } elseif (str_starts_with($clean, '+44')) {
            $countryCode = 'GB';
            $lineType = 'general';
        }

        return [
            'type'            => 'phone',
            'value'           => $raw,
            'normalized'      => $clean,
            'is_e164_valid'   => $isE164Valid,
            'country_code'    => $countryCode,
            'line_type'       => $lineType,
            'overall_valid'   => $isE164Valid,
        ];
    }

    /**
     * Batch validate multiple contact records
     */
    public function validateBatch(array $items): array
    {
        $results = [];
        foreach ($items as $item) {
            $type = strtolower($item['type'] ?? '');
            $val = $item['value'] ?? '';

            if (in_array($type, ['email'])) {
                $results[] = $this->validateEmail($val);
            } elseif (in_array($type, ['phone', 'mobile', 'whatsapp'])) {
                $results[] = $this->validatePhone($val);
            } else {
                $results[] = [
                    'type'          => $type,
                    'value'         => $val,
                    'overall_valid' => !empty($val),
                ];
            }
        }
        return $results;
    }
}
