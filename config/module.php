<?php

return [
    'modules' => [
        'Contact' => [
            'contact_recipient_name' => env('CONTACT_US_RECIPIENT_NAME', 'Fred Smith'),
            'contact_recipient_email' => env('CONTACT_US_RECIPIENT_EMAIL', 'fred@example.com'),
            'contact_subject'           => env('CONTACT_US_SUBJECT', 'Contact Us Submission')
        ]
    ]
];
