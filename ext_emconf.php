<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'Kuhschnappel - Authtoken',
	'description' => 'Once installed you can create authentication tokens for frontend users in the backend. You can then retrieve protected pages by submitting this token as an "X-User-Token" with the header.',
	'category' => 'plugin',
	'author' => 'Mike Zimmer',
	'author_email' => 'kuhschnappel@gmail.com',
	'state' => 'stable',
	'uploadfolder' => NULL,
	'createDirs' => NULL,
	'clearCacheOnLoad' => true,
	'version' => '2.1.0',
	'constraints' => [
		'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'php' => '7.4.1-8.1.99',
        ],
        'conflicts' => [],
        'suggests' => [],
	],
	'autoload' => [
		'psr-4' => [
			'Kuhschnappel\\Authtoken\\' => 'Classes'
		]
	],
];
