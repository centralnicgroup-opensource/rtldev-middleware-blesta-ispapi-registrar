<?php

/**
 * @copyright Copyright (c) 2018-2024, CNR
 * @license https://raw.githubusercontent.com/centralnicgroup-opensource/rtldev-middleware-blesta/master/LICENSE MIT
 */

// Transfer fields
Configure::set('Cnr.transfer_fields', [
    'domain' => [
        'label' => Language::_('Cnr.transfer.domain', true),
        'type' => 'text'
    ],
    'transfer_key' => [
        'label' => Language::_('Cnr.transfer.EPPCode', true),
        'type' => 'text'
    ]
]);

// Domain fields
Configure::set('Cnr.domain_fields', [
    'domain' => [
        'label' => Language::_('Cnr.domain.domain', true),
        'type' => 'text'
    ],
]);

// Nameserver fields
Configure::set('Cnr.nameserver_fields', [
    'ns1' => [
        'label' => Language::_('Cnr.nameserver.ns1', true),
        'type' => 'text'
    ],
    'ns2' => [
        'label' => Language::_('Cnr.nameserver.ns2', true),
        'type' => 'text'
    ],
    'ns3' => [
        'label' => Language::_('Cnr.nameserver.ns3', true),
        'type' => 'text'
    ],
    'ns4' => [
        'label' => Language::_('Cnr.nameserver.ns4', true),
        'type' => 'text'
    ],
    'ns5' => [
        'label' => Language::_('Cnr.nameserver.ns5', true),
        'type' => 'text'
    ]
]);

// Whois sections
Configure::set('Cnr.whois_sections', [
    'Registrant',
    'Tech',
    'Admin',
    'Billing'
]);

// Whois fields
Configure::set('Cnr.whois_fields', [
    'RegistrantFirstName' => [
        'label' => Language::_('Cnr.whois.RegistrantFirstName', true),
        'type' => 'text'
    ],
    'RegistrantLastName' => [
        'label' => Language::_('Cnr.whois.RegistrantLastName', true),
        'type' => 'text'
    ],
    'RegistrantOrganization' => [
        'label' => Language::_('Cnr.whois.RegistrantOrganization', true),
        'type' => 'text'
    ],
    'RegistrantAddress1' => [
        'label' => Language::_('Cnr.whois.RegistrantAddress1', true),
        'type' => 'text'
    ],
    'RegistrantAddress2' => [
        'label' => Language::_('Cnr.whois.RegistrantAddress2', true),
        'type' => 'text'
    ],
    'RegistrantCity' => [
        'label' => Language::_('Cnr.whois.RegistrantCity', true),
        'type' => 'text'
    ],
    'RegistrantStateProvince' => [
        'label' => Language::_('Cnr.whois.RegistrantStateProvince', true),
        'type' => 'text'
    ],
    'RegistrantPostalCode' => [
        'label' => Language::_('Cnr.whois.RegistrantPostalCode', true),
        'type' => 'text'
    ],
    'RegistrantCountry' => [
        'label' => Language::_('Cnr.whois.RegistrantCountry', true),
        'type' => 'text'
    ],
    'RegistrantPhone' => [
        'label' => Language::_('Cnr.whois.RegistrantPhone', true),
        'type' => 'text'
    ],
    'RegistrantEmailAddress' => [
        'label' => Language::_('Cnr.whois.RegistrantEmailAddress', true),
        'type' => 'text'
    ],
    'TechFirstName' => [
        'label' => Language::_('Cnr.whois.TechFirstName', true),
        'type' => 'text'
    ],
    'TechLastName' => [
        'label' => Language::_('Cnr.whois.TechLastName', true),
        'type' => 'text'
    ],
    'TechOrganization' => [
        'label' => Language::_('Cnr.whois.TechOrganization', true),
        'type' => 'text'
    ],
    'TechAddress1' => [
        'label' => Language::_('Cnr.whois.TechAddress1', true),
        'type' => 'text'
    ],
    'TechAddress2' => [
        'label' => Language::_('Cnr.whois.TechAddress2', true),
        'type' => 'text'
    ],
    'TechCity' => [
        'label' => Language::_('Cnr.whois.TechCity', true),
        'type' => 'text'
    ],
    'TechStateProvince' => [
        'label' => Language::_('Cnr.whois.TechStateProvince', true),
        'type' => 'text'
    ],
    'TechPostalCode' => [
        'label' => Language::_('Cnr.whois.TechPostalCode', true),
        'type' => 'text'
    ],
    'TechCountry' => [
        'label' => Language::_('Cnr.whois.TechCountry', true),
        'type' => 'text'
    ],
    'TechPhone' => [
        'label' => Language::_('Cnr.whois.TechPhone', true),
        'type' => 'text'
    ],
    'TechEmailAddress' => [
        'label' => Language::_('Cnr.whois.TechEmailAddress', true),
        'type' => 'text'
    ],
    'AdminFirstName' => [
        'label' => Language::_('Cnr.whois.AdminFirstName', true),
        'type' => 'text'
    ],
    'AdminLastName' => [
        'label' => Language::_('Cnr.whois.AdminLastName', true),
        'type' => 'text'
    ],
    'AdminOrganization' => [
        'label' => Language::_('Cnr.whois.AdminOrganization', true),
        'type' => 'text'
    ],
    'AdminAddress1' => [
        'label' => Language::_('Cnr.whois.AdminAddress1', true),
        'type' => 'text'
    ],
    'AdminAddress2' => [
        'label' => Language::_('Cnr.whois.AdminAddress2', true),
        'type' => 'text'
    ],
    'AdminCity' => [
        'label' => Language::_('Cnr.whois.AdminCity', true),
        'type' => 'text'
    ],
    'AdminStateProvince' => [
        'label' => Language::_('Cnr.whois.AdminStateProvince', true),
        'type' => 'text'
    ],
    'AdminPostalCode' => [
        'label' => Language::_('Cnr.whois.AdminPostalCode', true),
        'type' => 'text'
    ],
    'AdminCountry' => [
        'label' => Language::_('Cnr.whois.AdminCountry', true),
        'type' => 'text'
    ],
    'AdminPhone' => [
        'label' => Language::_('Cnr.whois.AdminPhone', true),
        'type' => 'text'
    ],
    'AdminEmailAddress' => [
        'label' => Language::_('Cnr.whois.AdminEmailAddress', true),
        'type' => 'text'
    ],
    'BillingFirstName' => [
        'label' => Language::_('Cnr.whois.BillingFirstName', true),
        'type' => 'text'
    ],
    'BillingLastName' => [
        'label' => Language::_('Cnr.whois.BillingLastName', true),
        'type' => 'text'
    ],
    'BillingOrganization' => [
        'label' => Language::_('Cnr.whois.BillingOrganization', true),
        'type' => 'text'
    ],
    'BillingAddress1' => [
        'label' => Language::_('Cnr.whois.BillingAddress1', true),
        'type' => 'text'
    ],
    'BillingAddress2' => [
        'label' => Language::_('Cnr.whois.BillingAddress2', true),
        'type' => 'text'
    ],
    'BillingCity' => [
        'label' => Language::_('Cnr.whois.BillingCity', true),
        'type' => 'text'
    ],
    'BillingStateProvince' => [
        'label' => Language::_('Cnr.whois.BillingStateProvince', true),
        'type' => 'text'
    ],
    'BillingPostalCode' => [
        'label' => Language::_('Cnr.whois.BillingPostalCode', true),
        'type' => 'text'
    ],
    'BillingCountry' => [
        'label' => Language::_('Cnr.whois.BillingCountry', true),
        'type' => 'text'
    ],
    'BillingPhone' => [
        'label' => Language::_('Cnr.whois.BillingPhone', true),
        'type' => 'text'
    ],
    'BillingEmailAddress' => [
        'label' => Language::_('Cnr.whois.BillingEmailAddress', true),
        'type' => 'text'
    ]
]);

// DNSSEC
Configure::set('Cnr.dnssec', [
    'flags' => [
        'label' => Language::_('Cnr.dnssec.flags', true),
        'type' => 'select',
        'options' => [
            '' => Language::_('AppController.select.please', true),
            '256' => 'Zone Signing Key (256)',
            '257' => 'Key Signing Key (257)'
        ]
    ],
    'digest_type' => [
       'label' => Language::_('Cnr.dnssec.digest_type', true),
       'type' => 'select',
       'options' => [
           '' => Language::_('AppController.select.please', true),
           '2' => 'SHA-256 (2)',
           '3' => 'GOST R 34.11-94 (3)',
           '4' => 'SHA-384 (4)'
       ]
    ],
    'algorithm' => [
        'label' => Language::_('Cnr.dnssec.algorithm', true),
        'type' => 'select',
        'options' => [
            '' => Language::_('AppController.select.please', true),
            '8' => 'RSA/SHA-256 (8)',
            '10' => 'RSA/SHA-512 (10)',
            '12' => 'ECC-GOST (12)',
            '13' => 'ECDSA Curve P-256 with SHA-256 (13)',
            '14' => 'ECDSA Curve P-384 with SHA-384 (14)',
            '15' => 'Ed25519 (15)',
            '16' => 'Ed448 (16)'
        ]
    ],
]);

