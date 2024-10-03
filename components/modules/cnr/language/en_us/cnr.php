<?php

/**
 * @copyright Copyright (c) 2018-2024, CNR
 * @license https://raw.githubusercontent.com/centralnicgroup-opensource/rtldev-middleware-blesta/master/LICENSE MIT
 */

// Basics
$lang['Cnr.name'] = "CentralNic Reseller";
$lang['Cnr.description'] = 'Quickly access the resources to resell over 1000 TLDs with ease. CentralNic Reseller provides top-notch technology, support, and APIs for domain resellers, backed by a dedicated team.';
$lang['Cnr.module_row'] = 'Account';
$lang['Cnr.module_row_plural'] = 'Accounts';

// Module management
$lang['Cnr.add_module_row'] = 'Add Account';
$lang['Cnr.manage.module_rows_title'] = 'Accounts';
$lang['Cnr.manage.module_rows_heading.user'] = 'User';
$lang['Cnr.manage.module_rows_heading.key'] = 'Password';
$lang['Cnr.manage.module_rows_heading.sandbox'] = 'Sandbox / OT&E';
$lang['Cnr.manage.module_rows_heading.dnssec'] = 'DNSSEC Management';
$lang['Cnr.manage.module_rows_heading.options'] = 'Options';
$lang['Cnr.manage.module_rows.edit'] = 'Edit';
$lang['Cnr.manage.module_rows.delete'] = 'Delete';
$lang['Cnr.manage.module_rows.confirm_delete'] = 'Are you sure you want to delete this account?';
$lang['Cnr.manage.module_rows_no_results'] = 'There are no accounts.';

// Row Meta
$lang['Cnr.row_meta.user'] = 'User';
$lang['Cnr.row_meta.key'] = 'Password';
$lang['Cnr.row_meta.sandbox'] = 'Sandbox';
$lang['Cnr.row_meta.dnssec'] = 'DNSSEC Management';
$lang['Cnr.row_meta.true'] = 'Yes';
$lang['Cnr.row_meta.false'] = 'No';


// Add row
$lang['Cnr.add_row.box_title'] = 'Add CentralNic Reseller Account';
$lang['Cnr.add_row.basic_title'] = 'Basic Settings';
$lang['Cnr.add_row.add_btn'] = 'Add Account';

// Edit row
$lang['Cnr.edit_row.box_title'] = 'Edit CentralNic Reseller Account';
$lang['Cnr.edit_row.basic_title'] = 'Basic Settings';
$lang['Cnr.edit_row.add_btn'] = 'Update Account';

// Package fields
$lang['Cnr.package_fields.type'] = 'Type';
$lang['Cnr.package_fields.type_domain'] = 'Domain Registration';
$lang['Cnr.package_fields.type_ssl'] = 'SSL Certificate';
$lang['Cnr.package_fields.tld_options'] = 'TLDs';
$lang['Cnr.package_fields.ns1'] = 'Name Server 1';
$lang['Cnr.package_fields.ns2'] = 'Name Server 2';
$lang['Cnr.package_fields.ns3'] = 'Name Server 3';
$lang['Cnr.package_fields.ns4'] = 'Name Server 4';
$lang['Cnr.package_fields.ns5'] = 'Name Server 5';

// Service management
$lang['Cnr.tab_whois.title'] = 'Whois';
$lang['Cnr.tab_whois.section_Registrant'] = 'Registrant';
$lang['Cnr.tab_whois.section_Admin'] = 'Administrative';
$lang['Cnr.tab_whois.section_Tech'] = 'Technical';
$lang['Cnr.tab_whois.section_Billing'] = 'Billing';
$lang['Cnr.tab_whois.field_submit'] = 'Update Whois';

$lang['Cnr.tab_nameservers.title'] = 'Name Servers';
$lang['Cnr.tab_nameserver.field_ns'] = 'Name Server %1$s'; // %1$s is the name server number
$lang['Cnr.tab_nameservers.field_submit'] = 'Update Name Servers';

$lang['Cnr.tab_settings.title'] = 'Settings';
$lang['Cnr.tab_settings.field_registrar_lock'] = 'Registrar Lock';
$lang['Cnr.tab_settings.field_registrar_lock_yes'] = 'Registrar Lock. Recommended to activate it prevents unauthorized transfer.';
$lang['Cnr.tab_settings.field_registrar_lock_no'] = 'Release the registrar lock so the domain can be transferred.';
$lang['Cnr.tab_settings.field_registrar_lock_unsupported'] = 'Registrar Lock is not available for this domain/tld.';
$lang['Cnr.tab_settings.field_request_epp'] = 'Request EPP Code/Transfer Key';
$lang['Cnr.tab_settings.field_submit'] = 'Update Settings';
$lang['Cnr.tab_settings.WhoisPrivacy'] = "Whois Privacy (ID Protection)";
$lang['Cnr.tab_settings.WhoisPrivacy_unsupported'] = "Whois Privacy (ID Protection) is not available for this domain/tld.";

$lang['Cnr.tab_transfer.title'] = 'Transfer';
$lang['Cnr.tab_transfer.field_submit'] = 'Transfer Domain';

// Manual Renewals
$lang['Cnr.manage.manual_renewal'] = "Manually Renew (select years)";

// Domain Data
$lang['Cnr.renew.note'] = 'Please note that the CNR prices will be applied when you renew a domain';
$lang['Cnr.domain.domaininformation'] = 'Domain data at your registrar system:';
$lang['Cnr.domain.domainstatus'] = 'Status';
$lang['Cnr.domain.expirydate'] = 'Expiry Date';

// E-Mail Forwarding
$lang['Cnr.tab_email_forwarding'] = 'E-Mail Forwarding';
$lang['Cnr.tab_email_forwarding.title'] = 'Email Forwarding';
$lang['Cnr.tab_email_forwarding.desc'] = 'Email forwarding is automatically directing email sent from one address to a different email address. For example, if you had an existing email address of email@email.com, and then registered the domain newdomain.com, you could use email forward to direct sales@newdomain.com to your existing email@email.com email address.';
$lang['Cnr.tab_email_forwarding.heading_current_rules'] = 'Current Rules';
$lang['Cnr.tab_email_forwarding.heading_add_rule'] = 'Add Rule';
$lang['Cnr.tab_email_forwarding.heading_source'] = 'Source';
$lang['Cnr.tab_email_forwarding.heading_destination'] = 'Destination';
$lang['Cnr.tab_email_forwarding.heading_options'] = 'Options';
$lang['Cnr.tab_email_forwarding.option_delete'] = 'Delete';
$lang['Cnr.tab_email_forwarding.text_no_forwarding_rules'] = 'There are no E-Mail forwarding rules for this domain.';
$lang['Cnr.tab_email_forwarding.field_source'] = 'Source';
$lang['Cnr.tab_email_forwarding.field_destination'] = 'Destination';
$lang['Cnr.tab_email_forwarding.field_submit'] = 'Add Rule';

// Service management
$lang['Cnr.tab_whois.title'] = 'Whois';
$lang['Cnr.tab_whois.section_registrant'] = 'Registrant';
$lang['Cnr.tab_whois.section_admin'] = 'Administrative';
$lang['Cnr.tab_whois.section_tech'] = 'Technical';
$lang['Cnr.tab_whois.section_billing'] = 'Billing';
$lang['Cnr.tab_whois.field_submit'] = 'Update Whois';
$lang['Cnr.tab_whois.copy_registrant_info'] = 'Copy Registrant Info';

$lang['Cnr.tab_nameservers.title'] = 'Nameservers';
$lang['Cnr.tab_nameservers.desc'] = 'We allow up to 5 possible nameservers, although only 2 are required. It is important that you do not enter the IP address of the name server, but instead enter the actual name server name. Name servers are typically formatted like "NS1.host.com".';
$lang['Cnr.tab_nameservers.field_ns'] = 'Nameserver %1$s'; // %1$s is the name server number
$lang['Cnr.tab_nameservers.field_submit'] = 'Update Nameservers';

$lang['Cnr.tab_private_nameservers.title'] = 'Nameserver Hosts';
$lang['Cnr.tab_private_nameservers.desc'] = 'If you are already familiar with setting up custom name servers and understand how DNS works, you can create custom name servers and assign it to your domain.';
$lang['Cnr.tab_private_nameservers.field_host'] = 'Hostname %1$s'; // %1$s is the host number
$lang['Cnr.tab_private_nameservers.field_ip'] = 'IP Address(es)';
$lang['Cnr.tab_private_nameservers.field_hostname'] = 'Hostname';
$lang['Cnr.tab_private_nameservers.field_submit'] = 'Add New';
$lang['Cnr.tab_private_nameservers.actions'] = 'Actions';
$lang['Cnr.tab_private_nameservers.help_text'] = 'On this page you can add your own custom name servers (sometimes referred to as "glue records") to associate with your domains.  To remove a host record blank all IP fields associated with it before clicking update.  You can not delete any host records which have domains actively using it as a nameserver.';

$lang['Cnr.tab_dnssec.title'] = 'DNSSEC';
$lang['Cnr.tab_dnssec.ds_title_list'] = 'Current DS (DNSSEC) Records';
$lang['Cnr.tab_dnssec.key_title_list'] = 'Current Key (DNSSEC) Records';
$lang['Cnr.tab_dnssec.ds_title_add'] = 'Add DS (DNSSEC) Record';
$lang['Cnr.tab_dnssec.key_title_add'] = 'Add Key (DNSSEC) Record';
$lang['Cnr.tab_dnssec.field_add'] = 'Add Record';
$lang['Cnr.tab_dnssec.field_actions'] = 'Actions';
$lang['Cnr.tab_dnssec.field_delete'] = 'Delete';
$lang['Cnr.tab_dnssec.title_disclaimer'] = 'Disclaimer';
$lang['Cnr.tab_dnssec.warning_message1'] = 'You can use this page to manage the DS/Key records for your domain. You should only use this page if you are comfortable with DS/Key records and DNSSEC.';
$lang['Cnr.tab_dnssec.warning_message2'] = 'When you manage DS/Key records, <strong>the domain will stop resolving correctly</strong> if your nameservers are not configured correctly with the associated DNSSEC resource records.';

$lang['Cnr.dnssec.algorithm'] = 'Algorithm';
$lang['Cnr.dnssec.digest_type'] = 'Digest Type';
$lang['Cnr.dnssec.digest'] = 'Digest';
$lang['Cnr.dnssec.flags'] = 'Flags';
$lang['Cnr.dnssec.key_tag'] = 'Key Tag';
$lang['Cnr.dnssec.public_key'] = 'Public Key';
$lang['Cnr.dnssec.protocol'] = 'Protocol';
$lang['Cnr.dnssec.nodata'] = 'No Records found!';
$lang['Cnr.dnssec.unsupported'] = 'DNSSEC is not supported for this domain.';

// DNS management
$lang['Cnr.tab_dnsrecord.title'] = 'DNS Management';
$lang['Cnr.tab_dnsrecord.title_list'] = 'Current DNS Records';
$lang['Cnr.tab_dnsrecord.title_add'] = 'Add a DNS Record';
$lang['Cnr.tab_dnsrecord.field_delete'] = 'Delete Record(s)';
$lang['Cnr.tab_dnsrecord.field_add'] = 'Add Record';
$lang['Cnr.tab_dnsrecord.help_text_1'] = 'On this page you can add or delete A, AAAA, CNAME, MX and TXT DNS records. Please be ware that it might take some few minutes for DNS records to propagate.';
$lang['Cnr.tab_dnsrecord.unsupported'] = 'Creation of DNS Zone for the requested domain failed. Please refresh this page again!';

$lang['Cnr.dnsrecord.record_type'] = 'Type';
$lang['Cnr.dnsrecord.host'] = 'Host';
$lang['Cnr.dnsrecord.value'] = 'Value';
$lang['Cnr.dnsrecord.priority'] = 'Priority';
$lang['Cnr.dnsrecord.ttl'] = 'TTL';
$lang['Cnr.dnsrecord.field_delete'] = 'Delete Record(s)';

$lang['Cnr.dns_records.record_type'] = 'Record Type';
$lang['Cnr.dns_records.record_type.a_record'] = 'A Record';
$lang['Cnr.dns_records.record_type.aaaa_record'] = 'AAAA Record';
$lang['Cnr.dns_records.record_type.cname_record'] = 'CNAME Record';
$lang['Cnr.dns_records.record_type.mx_record'] = 'MX Record';
$lang['Cnr.dns_records.record_type.txt_record'] = 'TXT Record';

// Errors
$lang['Cnr.!error.user.valid'] = 'Please enter a user.';
$lang['Cnr.!error.key.valid'] = 'Please enter a password.';
$lang['Cnr.!error.key.valid_connection'] = 'The user and password combination appear to be invalid, or your CentralNic Reseller account may not be configured to allow API access.';


// Domain Transfer Fields
$lang['Cnr.transfer.domain'] = 'Domain Name';
$lang['Cnr.transfer.EPPCode'] = 'EPP Code';
$lang['Cnr.transfer.EPPCodeTransfer'] = 'EPP Code ( if required )';
#$lang['Cnr.transfer.transfer_key'] = 'EPP Code';


// Domain Fields
$lang['Cnr.domain.domain'] = 'Domain Name';
$lang['Cnr.domain.NumYears'] = 'Years';
$lang['Cnr.domain.WhoisPrivacy'] = "Whois Privacy";
$lang["Cnr.domain.DomainAction"] = "Domain Action";
$lang["Cnr.domain.TldSelection"] = "Select a TLD";
$lang['Cnr.domain.registrationPeriod'] = 'Registration Period';

// Nameserver Fields
$lang['Cnr.nameserver.ns1'] = 'Name Server 1';
$lang['Cnr.nameserver.ns2'] = 'Name Server 2';
$lang['Cnr.nameserver.ns3'] = 'Name Server 3';
$lang['Cnr.nameserver.ns4'] = 'Name Server 4';
$lang['Cnr.nameserver.ns5'] = 'Name Server 5';

// Whois Fields
$lang['Cnr.whois.RegistrantFirstName'] = 'First Name';
$lang['Cnr.whois.RegistrantLastName'] = 'Last Name';
$lang['Cnr.whois.RegistrantOrganization'] = 'Company Name';
$lang['Cnr.whois.RegistrantAddress1'] = 'Address 1';
$lang['Cnr.whois.RegistrantAddress2'] = 'Address 2';
$lang['Cnr.whois.RegistrantCity'] = 'City';
$lang['Cnr.whois.RegistrantStateProvince'] = 'State/Province';
$lang['Cnr.whois.RegistrantPostalCode'] = 'Postal Code';
$lang['Cnr.whois.RegistrantCountry'] = 'Country';
$lang['Cnr.whois.RegistrantPhone'] = 'Phone';
$lang['Cnr.whois.RegistrantEmailAddress'] = 'Email';

$lang['Cnr.whois.TechFirstName'] = 'First Name';
$lang['Cnr.whois.TechLastName'] = 'Last Name';
$lang['Cnr.whois.TechOrganization'] = 'Company Name';
$lang['Cnr.whois.TechAddress1'] = 'Address 1';
$lang['Cnr.whois.TechAddress2'] = 'Address 2';
$lang['Cnr.whois.TechCity'] = 'City';
$lang['Cnr.whois.TechStateProvince'] = 'State/Province';
$lang['Cnr.whois.TechPostalCode'] = 'Postal Code';
$lang['Cnr.whois.TechCountry'] = 'Country';
$lang['Cnr.whois.TechPhone'] = 'Phone';
$lang['Cnr.whois.TechEmailAddress'] = 'Email';

$lang['Cnr.whois.AdminFirstName'] = 'First Name';
$lang['Cnr.whois.AdminLastName'] = 'Last Name';
$lang['Cnr.whois.AdminOrganization'] = 'Company Name';
$lang['Cnr.whois.AdminAddress1'] = 'Address 1';
$lang['Cnr.whois.AdminAddress2'] = 'Address 2';
$lang['Cnr.whois.AdminCity'] = 'City';
$lang['Cnr.whois.AdminStateProvince'] = 'State/Province';
$lang['Cnr.whois.AdminPostalCode'] = 'Postal Code';
$lang['Cnr.whois.AdminCountry'] = 'Country';
$lang['Cnr.whois.AdminPhone'] = 'Phone';
$lang['Cnr.whois.AdminEmailAddress'] = 'Email';

$lang['Cnr.whois.BillingFirstName'] = 'First Name';
$lang['Cnr.whois.BillingLastName'] = 'Last Name';
$lang['Cnr.whois.BillingOrganization'] = 'Company Name';
$lang['Cnr.whois.BillingAddress1'] = 'Address 1';
$lang['Cnr.whois.BillingAddress2'] = 'Address 2';
$lang['Cnr.whois.BillingCity'] = 'City';
$lang['Cnr.whois.BillingStateProvince'] = 'State/Province';
$lang['Cnr.whois.BillingPostalCode'] = 'Postal Code';
$lang['Cnr.whois.BillingCountry'] = 'Country';
$lang['Cnr.whois.BillingPhone'] = 'Phone';
$lang['Cnr.whois.BillingEmailAddress'] = 'Email';

// Additional domain fields

// .US domain fields
$lang['Cnr.domain.RegistrantNexus'] = 'Registrant Type';
$lang['Cnr.domain.RegistrantNexus.c11'] = 'US citizen';
$lang['Cnr.domain.RegistrantNexus.c12'] = 'Permanent resident of the US';
$lang['Cnr.domain.RegistrantNexus.c21'] = 'US entity or organization';
$lang['Cnr.domain.RegistrantNexus.c31'] = 'Foreign organization';
$lang['Cnr.domain.RegistrantNexus.c32'] = 'Foreign organization with an office in the US';
$lang['Cnr.domain.RegistrantPurpose'] = 'Purpose';
$lang['Cnr.domain.RegistrantPurpose.p1'] = 'Business';
$lang['Cnr.domain.RegistrantPurpose.p2'] = 'Non-profit';
$lang['Cnr.domain.RegistrantPurpose.p3'] = 'Personal';
$lang['Cnr.domain.RegistrantPurpose.p4'] = 'Educational';
$lang['Cnr.domain.RegistrantPurpose.p5'] = 'Governmental';
$lang['Cnr.domain.RegistrantCountry'] = 'Specify the two-letter country-code of the registrant (if Nexus Category is either C31 or C32)';

// .BERLIN domain fields
$lang['Cnr.domain.BerlinOptions'] = 'Registrant and/or Admin-C are domiciled in Berlin / Use Local Presence Service';

// .RUHR domain fields
$lang['Cnr.domain.RuhrOptions'] = 'Registrant and/or Admin-C are domiciled in Ruhr / Use Local Presence Service';

// .HAMBURG domain fields
$lang['Cnr.domain.HamburgOptions'] = 'Registrant and/or Admin-C are domiciled in Hamburg / Use Local Presence Service';

// .BAYERN domain fields
$lang['Cnr.domain.BayernOptions'] = 'Registrant and/or Admin-C are domiciled in Bayern / Use Local Presence Service';

// .JP domain fields
$lang['Cnr.domain.JpOptions'] = 'Registrant and/or Admin-C are domiciled in Japan / Use Local Presence Service';

//.EU domain fields
$lang['Cnr.domain.euOptions'] = 'Registrant is domiciled in the EU / Use Local Presence Service';

// .SG domain fields
$lang['Cnr.domain.sgOptions'] = 'Registrant and/or Admin-C are domiciled in Singapore / Use Local Presence Service';
$lang['Cnr.domain.RCBSingaporeID'] = 'RCB/Singapore ID';
$lang['Cnr.domain.AdminIDnumber'] = 'Admin ID number';

// .AERO domain fields
$lang['Cnr.domain.AeroID'] = '.aero ID';
$lang['Cnr.domain.AeroPassword'] = 'Password';

// .TRAVEL domain fields
$lang['Cnr.domain.TravelIndustry'] = '.travel Industry';

// .FR domain fields
$lang['Cnr.domain.frOptions'] = 'Registrant and/or Admin-C are domiciled in France / Use Local Presence Service';
$lang['Cnr.domain.DateOfBirth'] = 'Date of Birth';
$lang['Cnr.domain.PlaceOfBirth'] = 'Place of Birth';
$lang['Cnr.domain.VatIDorSiren'] = 'VATID or SIREN/SIRET number';
$lang['Cnr.domain.TrademarkNumber'] = 'Trademark Number';
$lang['Cnr.domain.DunsNumber'] = 'DUNS number';
$lang['Cnr.domain.LocalID'] = 'Local ID';
$lang['Cnr.domain.DateOfDeclaration'] = 'Date of Declaration';
$lang['Cnr.domain.NumberJo'] = 'Number [JO]';
$lang['Cnr.domain.JoPage'] = 'Page of Announcement [JO]';
$lang['Cnr.domain.DateOfPublicationJo'] = 'Date of Publication [JO]';

// .JOBS domain fields
$lang['Cnr.domain.CompanyURL'] = 'Company URL';
$lang['Cnr.domain.IndustryClassification'] = 'Industry Classification';
$lang['Cnr.domain.AccountingBankingFinance'] = 'Accounting/Banking/Finance';
$lang['Cnr.domain.AgricultureFarming'] = 'Agriculture/Farming';
$lang['Cnr.domain.Biotechnologycience'] = 'Biotechnology/Science';
$lang['Cnr.domain.ComputerInformationechnology'] = 'Computer/Information Technology';
$lang['Cnr.domain.ConstructionBuildingServices'] = 'Construction/Building Services';
$lang['Cnr.domain.Consulting'] = 'Consulting';
$lang['Cnr.domain.EducationTrainingLibrary'] = 'Education/Training/Library';
$lang['Cnr.domain.Entertainment'] = 'Entertainment';
$lang['Cnr.domain.Environmental'] = 'Environmental';
$lang['Cnr.domain.Hospitality'] = 'Hospitality';
$lang['Cnr.domain.GovernmentCivilService'] = 'Government/Civil Service';
$lang['Cnr.domain.Healthcare'] = 'Healthcare';
$lang['Cnr.domain.HRRecruiting'] = 'HR/Recruiting';
$lang['Cnr.domain.Insurance'] = 'Insurance';
$lang['Cnr.domain.Legal'] = 'Legal';
$lang['Cnr.domain.Manufacturing'] = 'Manufacturing';
$lang['Cnr.domain.MediaAdvertising'] = 'Media/Advertising';
$lang['Cnr.domain.ParksRecreation'] = 'Parks & Recreation';
$lang['Cnr.domain.Pharmaceutical'] = 'Pharmaceutical';
$lang['Cnr.domain.RealEstate'] = 'Real Estate';
$lang['Cnr.domain.RestaurantFoodService'] = 'Restaurant/Food Service';
$lang['Cnr.domain.Retail'] = 'Retail';
$lang['Cnr.domain.Telemarketing'] = 'Telemarketing';
$lang['Cnr.domain.Transportation'] = 'Transportation';
$lang['Cnr.domain.Other'] = 'Other';

// .PRO domain fields
$lang['Cnr.domain.Profession'] = 'Profession';
$lang['Cnr.domain.Authority'] = 'Authority';
$lang['Cnr.domain.AuthorityWebsite'] = 'Authority Website';
$lang['Cnr.domain.LicenseNumber'] = 'License Number';
$lang['Cnr.domain.PROTerms'] = '.PRO Terms';
$lang['Cnr.domain.PROTerms.yes'] = 'Tick to confirm that you agree to the .PRO End User Terms Of Use at: http://www.registry.pro/legal/user-terms';

// .HK domain fields
$lang['Cnr.domain.RegistrantDocumentType'] = 'Registrant Document Type';
$lang['Cnr.domain.HongKongIdentityNumber'] = 'Individual - Hong Kong Identity Number';
$lang['Cnr.domain.OtherCountryIdentityNumber'] = 'Individual - Others Country Identity Number';
$lang['Cnr.domain.PassportNo'] = 'Individual - Passport No.';
$lang['Cnr.domain.BirthCertificate'] = 'Individual - Birth Certificate';
$lang['Cnr.domain.OthersIndividualDocument'] = 'Individual - Others Individual Document';
$lang['Cnr.domain.BusinessRegistrationCertificate'] = 'Organization - Business Registration Certificate';
$lang['Cnr.domain.CertificateofIncorporation'] = 'Organization - Certificate of Incorporation';
$lang['Cnr.domain.CertificateofRegistrationofaSchool'] = 'Organization - Certificate of Registration of a School';
$lang['Cnr.domain.HongKongSpecialAdministrativeRegionGovernment'] = 'Organization - Hong Kong Special Administrative Region Government Department';
$lang['Cnr.domain.OrdinanceofHongKong'] = 'Organization - Ordinance of Hong Kong';
$lang['Cnr.domain.OthersOrganizationDocument'] = 'Organization - Others Organization Document';
$lang['Cnr.domain.RegistrantDocumentNumber'] = 'Registrant Document Number';
$lang['Cnr.domain.RegistrantDocumentOriginCountry'] = 'Registrant Document Origin Country';
$lang['Cnr.domain.RegistrantBirthDateforindividuals'] = 'Registrant Birth Date for individuals';
$lang['Cnr.domain.HKTermsforindividuals'] = 'HK Terms for individuals';
$lang['Cnr.domain.HKTermsforindividuals.yes'] = 'Accept the .HK https://www.hkirc.hk/content.jsp?id=3#!/6 (mandatory, if the registrant is an individual)';

// .FI domain fields
$lang['Cnr.domain.FICORAAgreement'] = 'FICORA Agreement';
$lang['Cnr.domain.IDNumber'] = 'ID Number';
$lang['Cnr.domain.FIagreement.yes'] = 'I Accept the https://domain.fi/info/en/index/hakeminen/kukavoihakea.html FI Domain Name Agreement';

// .SE domain fields
$lang['Cnr.domain.RegistrantIDNumber'] = 'Registrant ID Number';
$lang['Cnr.domain.RegistrantVatID'] = 'Registrant VAT ID';

// .DK domain fields
$lang['Cnr.domain.RegistrantVatID'] = 'Registrant VAT ID';
$lang['Cnr.domain.AdminVATID'] = 'Admin VAT ID';
$lang['Cnr.domain.Registrantcontact'] = 'Registrant contact';
$lang['Cnr.domain.Admincontact'] = 'Admin contact';

// .IT domain fields
$lang['Cnr.domain.PIN'] = 'PIN';
$lang['Cnr.domain.Section3Agreemen'] = 'Section 3 Agreement';
$lang['Cnr.domain.Section3Agreemen.yes'] = 'Section 3 - Declarations and assumptions of liability The Registrant of the domain name in question, declares under their own responsibility that they are:
in possession of the citizenship or resident in a country belonging to the European Union (in the case of registration for natural persons);
established in a country belonging to the European Union (in the case of registration for other organizations);
aware and accept that the registration and management of a domain name is subject to the Rules of assignment and management of domain names in ccTLD. it and Regulations for the resolution of disputes in the ccTLD.it and their subsequent amendments;
entitled to the use and/or legal availability of the domain name applied for, and that they do not prejudice, with the request for registration, the rights of others;
aware that for the inclusion of personal data in the Database of assigned domain names, and their possible dissemination and accessibility via the Internet, consent must be given explicitly by ticking the appropriate boxes in the information below. See The policy of the .it Registry in the Whois Database on the website of the Registry (http://www.nic.it);
aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;
release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;
accept Italian jurisdiction and laws of the Italian State.';
$lang['Cnr.domain.Section5Agreemen'] = 'Section 5 Agreement';
$lang['Cnr.domain.Section5Agreemen.yes'] = 'Section 5 - Consent to the processing of personal data for registration
The interested party, after reading the above disclosure, gives consent to the processing of information required for registration, as defined in the above disclosure. Giving consent is optional, but if no consent is given, it will not be possible to finalize the registration, assignment and management of the domain name.';
$lang['Cnr.domain.Section6Agreemen'] = 'Section 6 Agreement';
$lang['Cnr.domain.Section6Agreemen.yes'] = 'Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet
The interested party, after reading the above disclosure, gives consent to the dissemination and accessibility via the Internet, as defined in the disclosure above. Giving consent is optional, but absence of consent does not allow the dissemination and accessibility of Internet data.';
$lang['Cnr.domain.Section7Agreemen'] = 'Section 7 Agreement';
$lang['Cnr.domain.Section7Agreemen.yes'] = 'Section 7 - Explicit Acceptance of the following points
For explicit acceptance, the interested party declares that they:
d) are aware and agree that the registration and management of a domain name is subject to the Rules of assignment and management of domain names in ccTLD.it and Regulations for the resolution of disputes in the ccTLD.it and their subsequent amendments;
e) are aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;
f) release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;
g) accept the Italian jurisdiction and laws of the Italian State.';

// .NYC domain fields
$lang['Cnr.domain.NEXUSCategory'] = 'NEXUS Category';
$lang['Cnr.domain.NaturalPerson'] = 'Natural Person - primary domicile with physical address in NYC';
$lang['Cnr.domain.Entityororganization'] = 'Entity or organization - primary domicile with physical address in NYC';

// .ES domain fields
$lang['Cnr.domain.RegistrantType'] = 'Registrant Type';
$lang['Cnr.domain.RegistrantIdentificationNumber'] = 'Registrant Identification Number';
$lang['Cnr.domain.AdminContactType'] = 'Admin-Contact Type';
$lang['Cnr.domain.AdminContactIdentificationNumber'] = 'Admin-Contact Identification Number';
$lang['Cnr.domain.ESAgreement'] = 'I agree to the .ES registration TAC for individuals';
$lang['Cnr.domain.Alien'] = 'Alien registration card';
$lang['Cnr.domain.NIF'] = 'NIF/NIE; For Spanish Individual or Organization';
$lang['Cnr.domain.Otra'] = 'Otra; For non-spanish owner';

// .ES .VOTE .VOTO
$lang['Cnr.domain.Agreement'] = 'Agreement';

// .IE domain fields
$lang['Cnr.domain.RegistrantClass'] = 'Registrant Class';
$lang['Cnr.domain.CompanyBusinessOwnerClub'] = 'Company,Business Owner,Club';
$lang['Cnr.domain.Band'] = 'Band';
$lang['Cnr.domain.LocalGroupSchool'] = 'Local Group,School';
$lang['Cnr.domain.CollegeStateAgencyCharityBlogger'] = 'College,State Agency,Charity,Blogger';
$lang['Cnr.domain.Other'] = 'Other';
$lang['Cnr.domain.ProofofconnectiontoIreland'] = 'Proof of connection to Ireland';

// .NU .NO domain fields
$lang['Cnr.domain.RegistrantIDnumber'] = 'Registrant ID number';

// .NU domain fields
$lang['Cnr.domain.VatID'] = 'Vat ID';

// . NO domain fields
$lang['Cnr.domain.Faxrequired'] = 'Fax required';
$lang['Cnr.domain.NOFaxrequired.yes'] = 'I confirm I will send the following form back to complete the registration process: http://www.domainform.net/form/no/search?view=registration';

// .VOTE domain fields
$lang['Cnr.domain.VOTEAgreement.yes'] = 'I confirm bona fide use of this domain name for a relevant election cycle with a clearly identified political/democratic process.';

// .VOTO domain fields
$lang['Cnr.domain.VOTOAgreement.yes'] = 'I confirm bona fide use of this domain name for a relevant election cycle with a clearly identified political/democratic process.';

// .RO domain fields
$lang['Cnr.domain.RegistrantVatID'] = 'Registrant VAT ID';
$lang['Cnr.domain.RegistrantIDnumber'] = 'Registrant ID Number';

// .IT .FR .SG .EU .DE .JP .BAYERN .HAMBURG .RUHR .BERLIN domain fields
$lang['Cnr.domain.LocalPresence'] = 'Local Presence';

// .DE domain fields
$lang['Cnr.domain.deOptions'] = 'Registrant and/or Admin-C are domiciled in Germany / Use Local Presence Service';

// .ECO domain fields
$lang['Cnr.domain.HighlyRegulatedTLD'] = 'I agree - Highly Regulated TLD:';
$lang['Cnr.domain.ECOHighlyRegulatedTLD.yes'] = 'All .ECO domain names will be first registered with “server hold” status pending the completion of the minimum requirements of the Eco Profile, namely, the .ECO registrant 1) affirming their compliance with the .ECO Eligibility Policy and 2) pledging to support positive change for the planet and to be honest when sharing information on their environmental actions. The registrant will be emailed with instructions on how to create an Eco Profile. Once these steps have been completed, the .ECO domain will be immediately activated by the registry.';

// .PT domain fields
$lang['Cnr.domain.RegistrantVatID'] = 'Registrant Vat ID';
$lang['Cnr.domain.TechvatID'] = 'Tech Vat ID';

// .LV domain fields
$lang['Cnr.domain.VatID'] = 'Vat ID';
$lang['Cnr.domain.IDnumber'] = 'ID number';

// .SWISS domain fields
$lang['Cnr.domain.EnterpriseID'] = 'Enterprise ID';
$lang['Cnr.domain.SWISSIntendeduse'] = 'Intended use';

// .SCOT domain fields
$lang['Cnr.domain.SCOTIntendeduse'] = 'Intended use';

// .QUEBEC domain fields
$lang['Cnr.domain.QUEBECIntendeduse'] = 'Intended use';

// .COM.AU domain fields
$lang['Cnr.domain.RegistrantIDType'] = 'Registrant ID Type';
$lang['Cnr.domain.AustralianBusinessNumber'] = 'Australian Business Number';
$lang['Cnr.domain.AustralianCompanyNumber'] = 'Australian Company Number';
$lang['Cnr.domain.BusinessRegistrationNumber'] = 'Business Registration Number';
$lang['Cnr.domain.TrademarkNumber'] = 'Trademark Number';

// .CA domain fields
$lang['Cnr.domain.CIRALegalType'] = 'Legal Type';
$lang['Cnr.domain.RegistrantPurpose.cco'] = 'Corporation';
$lang['Cnr.domain.RegistrantPurpose.cct'] = 'Canadian citizen';
$lang['Cnr.domain.RegistrantPurpose.res'] = 'Canadian resident';
$lang['Cnr.domain.RegistrantPurpose.gov'] = 'Government entity';
$lang['Cnr.domain.RegistrantPurpose.edu'] = 'Educational';
$lang['Cnr.domain.RegistrantPurpose.ass'] = 'Unincorporated Association';
$lang['Cnr.domain.RegistrantPurpose.hop'] = 'Hospital';
$lang['Cnr.domain.RegistrantPurpose.prt'] = 'Partnership';
$lang['Cnr.domain.RegistrantPurpose.tdm'] = 'Trade-mark';
$lang['Cnr.domain.RegistrantPurpose.trd'] = 'Trade Union';
$lang['Cnr.domain.RegistrantPurpose.plt'] = 'Political Party';
$lang['Cnr.domain.RegistrantPurpose.lam'] = 'Libraries, Archives and Museums';
$lang['Cnr.domain.RegistrantPurpose.trs'] = 'Trust';
$lang['Cnr.domain.RegistrantPurpose.abo'] = 'Aboriginal Peoples';
$lang['Cnr.domain.RegistrantPurpose.inb'] = 'Indian Band';
$lang['Cnr.domain.RegistrantPurpose.lgr'] = 'Legal Representative';
$lang['Cnr.domain.RegistrantPurpose.omk'] = 'Official Mark';
$lang['Cnr.domain.RegistrantPurpose.maj'] = 'The Queen';
$lang['Cnr.domain.CIRAWhoisDisplay'] = 'Whois';
$lang['Cnr.domain.CIRAWhoisDisplay.full'] = 'Make Public';
$lang['Cnr.domain.CIRAWhoisDisplay.private'] = 'Keep Private';
$lang['Cnr.domain.CIRALanguage'] = 'Preferred language for communication';
$lang['Cnr.domain.CIRALanguage.en'] = 'English';
$lang['Cnr.domain.CIRALanguage.fr'] = 'French';

// #########################################################################
// #########################################################################
// # Add translations for CNR registrar module additional domain fields    #
// #########################################################################
// #########################################################################

// ----------------------------------------------------------------------
// ------------------ Common CNR Translations ---------------------------
// ----------------------------------------------------------------------
$lang["Cnr.choose"] = "Please Choose";
$lang["Cnr.optional"] = "(optional)";
$lang["Cnr.1"] = "Yes";
$lang["Cnr.0"] = "No";
$lang["Cnr.consentforpublishing"] = "Registrant, Consent for Publishing";

// NOTE: The following translations are labeled as boilerplate and should
// be used as a template for other languages. English texts are returned
// by default from the CNR Backend System. If you want to override these
// default texts, please consider a language override file in WHMCS using
// the below translation keys.
// We added some translations to override the API defaults which sometimes
// suck.
//
// ----------------------------------------------------------------------
// ------------------ .EU Fields, Boilerplate ---------------------------
// ----------------------------------------------------------------------
$lang["Cnr.xeuregistrantlang"] = "Registrant, Language";
$lang["Cnr.xeuregistrantcitizenship"] = "Registrant, Citizenship";
$lang["Cnr.xeuregistrantlangdescr"] = "Language to use for communication with the TLD Provider (Default = English)";
$lang["Cnr.xeuregistrantcitizenshipdescr"] = "";

// ----------------------------------------------------------------------
// ------------------ .DE Fields, Boilerplate ---------------------------
// ----------------------------------------------------------------------
//$lang["Cnr.xdensentry0"] = "";
$lang["Cnr.xdensentry0descr"] = implode(" ", [
    "Enables the use of nsentrys instead of nameservers for .de domains;",
    "NS records allow you to configure subdomains with alternative nameservers.",
    "<a target=\"_blank\" href=\"https://www.denic.de/en/domains/de-domains/registration/nameserver-and-nsentry-data/\" style=\"text-decoration:underline\">Detailed Read</a>."
]);
//$lang["Cnr.xdensentry1"] = "";https://www.denic.de/en/domains/de-domains/registration/nameserver-and-nsentry-data/
$lang["Cnr.xdensentry1descr"] = "see above";
//$lang["Cnr.xdensentry2"] = "";
$lang["Cnr.xdensentry2descr"] = "see above";
//$lang["Cnr.xdensentry3"] = "";
$lang["Cnr.xdensentry3descr"] = "see above";
//$lang["Cnr.xdensentry4"] = "";
$lang["Cnr.xdensentry4descr"] = "see above";
//$lang["Cnr.xdegeneralrequest"] = "";
//$lang["Cnr.xdegeneralrequestdescr"] = "";
//$lang["Cnr.xdeabusecontact"] = "";
//$lang["Cnr.xdeabusecontactdescr "] = "";

// ----------------------------------------------------------------------
// ------------------ .IT Fields, Boilerplate ---------------------------
// ----------------------------------------------------------------------
$lang["Cnr.xitconsentforpublishing"] = $lang["Cnr.consentforpublishing"];
$lang["Cnr.xitconsentforpublishing0"] = $lang["Cnr.0"];
$lang["Cnr.xitconsentforpublishing1"] = $lang["Cnr.1"];
$lang["Cnr.xitconsentforpublishingdescr"] = "Allow the publication of contacts personal data. Deny only possible if Entity Type below is 1.";
$lang["Cnr.xitentitytype"] = "Registrant, Entity Type";
$lang["Cnr.xitentitytype1"] = "[1] Italian and foreign natural persons";
$lang["Cnr.xitentitytype2"] = "[2] Companies/one man companies";
$lang["Cnr.xitentitytype3"] = "[3] Freelance workers/professionals";
$lang["Cnr.xitentitytype4"] = "[4] non-profit organizations";
$lang["Cnr.xitentitytype5"] = "[5] public organizations";
$lang["Cnr.xitentitytype6"] = "[6] other subjects";
$lang["Cnr.xitentitytype7"] = "[7] foreigners who match 2-6";
$lang["Cnr.xitentitytypedescr"] = "Entity Type to identify the Registrant Typology.";
$lang["Cnr.xitpin"] = "Registrant, Tax ID";
//$lang["Cnr.xitpindescr"] = "";
$lang["Cnr.xitnationality"] = "Registrant, Nationality";
$lang["Cnr.xitnationalitydescr"] = "The Nationality of the Registrant specified by 2-char ISO Country Code.";
//$lang["Cnr.xitsect3liability"] = "";
$lang["Cnr.xitsect3liabilitydescr"] = "";
$lang["Cnr.xitsect3liability0"] = $lang["Cnr.0"];
$lang["Cnr.xitsect3liability1"] = $lang["Cnr.1"];
//$lang["Cnr.xitsect5personaldataforregistration"] = "";
$lang["Cnr.xitsect5personaldataforregistrationdescr"] = "";
$lang["Cnr.xitsect5personaldataforregistration0"] = $lang["Cnr.0"];
$lang["Cnr.xitsect5personaldataforregistration1"] = $lang["Cnr.1"];
//$lang["Cnr.xitsect6personaldatafordiffusion"] = "";
$lang["Cnr.xitsect6personaldatafordiffusiondescr"] = "";
$lang["Cnr.xitsect6personaldatafordiffusion0"] = $lang["Cnr.0"];
$lang["Cnr.xitsect6personaldatafordiffusion1"] = $lang["Cnr.1"];
//$lang["Cnr.xitsect7explicitacceptance"] = "";
$lang["Cnr.xitsect7explicitacceptancedescr"] = "";
$lang["Cnr.xitsect7explicitacceptance0"] = $lang["Cnr.0"];
$lang["Cnr.xitsect7explicitacceptance1"] = $lang["Cnr.1"];

// ----------------------------------------------------------------------
// ------------------ .FR, .PM, .RE, .TF, .WF, .YT Fields, Boilerplate --
// ----------------------------------------------------------------------
// Organizations (Companies, Associations, etc.)
$lang["Cnr.xfrannounce"] = "Company, Number of Announcement (Journal Officiel)";
$lang["Cnr.xfrannouncedescr"] = "The number of the announcement (e.g. 5) in the Journal Officiel. Only digits allowed.";
$lang["Cnr.xfrdatepublicationjo"] = "Company, Date of Publication (Journal Officiel)";
$lang["Cnr.xfrdatepublicationjodescr"] = implode(" ", [
    "The date of publication in the official gazette / Journal Officiel.",
    "Date format YYYY-MM-DD"
]);
$lang["Cnr.xfrnumerodepageannouncejo"] = "Company, Page No. of Announcement (Journal Officiel)";
$lang["Cnr.xfrnumerodepageannouncejodescr"] = "The page number of the announcement in the Journal Officiel.";
$lang["Cnr.xfrwaldec"] = "Company, Waldec ID";
$lang["Cnr.xfrwaldecdescr"] = "Indicates the Waldec identifier linked to an association which is sufficient to identify an association if provided. Only digits allowed.";
$lang["Cnr.xfrdateassociation"] = "Company, Date of Association";
$lang["Cnr.xfrdateassociationdescr"] = "Shows the date of association. Date Format YYYY-MM-DD.";
$lang["Cnr.xfrduns"] = "Company, DUNS Number";
$lang["Cnr.xfrdunsdescr"] = implode(" ", [
    "The DUNS number is a unique nine-digit identifier for businesses. Short for Data Universal",
    "Numbering System; refers to a new identifier that can be sent for an Eligibility Verification",
    "at European level."
]);
$lang["Cnr.xfrlocal"] = "Company, Local ID";
$lang["Cnr.xfrlocaldescr"] = "A local identifier specific to a country of the European Economic Area (e.g. business certificate number).";
$lang["Cnr.xfrnoprezonecheck0"] = $lang["Cnr.0"];
$lang["Cnr.xfrnoprezonecheck1"] = $lang["Cnr.1"];
$lang["Cnr.xfrsirenorsiret"] = "Company, SIREN/SIRET Number";
$lang["Cnr.xfrsirenorsiretdescr"] = implode(" ", [
    "For companies with valid SIREN/SIRET number.",
    "The SIREN code is the unique business identification number in France. It is issued by the",
    "institut national de la statistique et des études économiques (INSEE) and has 9 digits.",
    "The first 9 digits are the SIREN number and the following 5 digits are the NIC number",
    "(Numéro Interne de Classement). The SIRET number is issued once you have registered your",
    "business with the Chambre de Commerce (RCS) for trade, Chambre de Metiers for crafts and",
    "manual work or with URSSAF for intellectual services. SIRET numbers are made up of 14",
    "numbers. The SIRET number provides information about the location of the business in France",
    "(for established companies). The company name provided in the registrant contact details must",
    "be exactly the same as shown in the SIREN/SIRET database ( https://www.infogreffe.fr/ )."
]);
$lang["Cnr.xfrtrademark"] = "Company, Trademark No.";
$lang["Cnr.xfrtrademarkdescr"] = "";
$lang["Cnr.xfrvatid"] = "Company, VAT ID";
$lang["Cnr.xfrvatiddescr"] = "For companies with valid VATID";

// Individual
$lang["Cnr.xfrbirthpc"] = "Registrant, ZIP Code (City of Birth)";
$lang["Cnr.xfrbirthpcdescr"] = implode(" ", [
    "Only for natural persons born in France, Reunion, Mayotte, Guadeloupe, Martinique, Guyane,",
    "Polynesie Francaise, Wallis et Futuna or Saint-Pierre-et-Miquelon. Please provide the",
    "postcode of the place of birth (or at least the department code)"
]);
$lang["Cnr.xfrbirthcity"] = "Registrant, City of Birth";
$lang["Cnr.xfrbirthcitydescr"] = implode(" ", [
    "Only for natural persons born in France, Reunion, Mayotte, Guadeloupe, Martinique, Guyane,",
    "Polynesie Francaise, Wallis et Futuna or Saint-Pierre-et-Miquelon. Please provide the Name",
    "of City."
]);
$lang["Cnr.xfrbirthdate"] = "Registrant, Date of Birth";
$lang["Cnr.xfrbirthdatedescr"] = "The registrant's birthdate in the form YYYY-MM-DD.";
$lang["Cnr.xfrbirthplace"] = "Registrant, Place of Birth";
//$lang["Cnr.xfrbirthplacedescr"] = "";
$lang["Cnr.xfrrestrictpub"] = $lang["Cnr.consentforpublishing"];
$lang["Cnr.xfrrestrictpub0"] = $lang["Cnr.0"];
$lang["Cnr.xfrrestrictpub1"] = $lang["Cnr.1"];
$lang["Cnr.xfrrestrictpubdescr"] = "For Individuals only. Allow the publication of contacts personal data.";

// --- no idea about these fields:
// $lang["Cnr.xfrnoprezonecheck"] = "";
// $lang["Cnr.xfrnoprezonecheckdescr"] = "";


// ... and so on for other TLDs (Coming soon / on customer demand!)