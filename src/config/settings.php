<?php
return [
  [
    'key' => 'contact_email',
    'name' => 'Contact form email address',
    'description' => 'The email address that all emails from the contact form will go to.',
    'value' => 'admin@updivision.com',
    'field' => '{"name":"value", "label":"Value", "type":"email"}',
    'active' => 1,
  ],
  [
    'key' => 'contact_cc',
    'name' => 'Contact form CC field',
    'description' => 'Email addresses separated by comma, to be included as CC in the email sent by the contact form.',
    'value' => '',
    'field' => '{"name":"value", "label":"Value", "type":"text"}',
    'active' => 1,

  ],
  [
    'key' => 'contact_bcc',
    'name' => 'Contact form BCC field',
    'description' => 'Email addresses separated by comma, to be included as BCC in the email sent by the contact form.',
    'value' => '',
    'field' => '{"name":"value", "label":"Value", "type":"email"}',
    'active' => 1,
  ],
  [
    'key' => 'motto',
    'name' => 'Motto',
    'description' => 'Website motto',
    'value' => 'this is the value',
    'field' => '{"name":"value", "label":"Value", "type":"textarea"}',
    'active' => 1,

  ],
];
