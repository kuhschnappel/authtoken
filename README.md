# Kuhschnappel - Authtoken

## Extension Configuration

You can change the variable name used for token authentication.

```Default: X-User-Token```

## Handling of the tokens in the backend

- You can easily add one or more tokens to the frontend user in the backend.
- You can restrict the tokens to a period of time or temporarily deactivate them.
- The time of the last use is displayed for each token.

## Purpose of use

- Pages that are only released for special users can be called up using the tokens without prior login in the frontend. For this, the token must be supplied with the request header.
- This is of particular interest for simple, protected API calls (including formats such as JSON).

## Curl Example

```curl -H "X-User-Token: autogeneratedtokenvalue" https://domain.tld/page```

## Changelog

| Version     | Release Date | Description                                            |
|-------------|--------------|--------------------------------------------------------|
| 2.1.0       | 2023-09-03   | Add usage counter.                                     |
|             |              | Bugfix service integration to prevent doubled request. |
| 2.1.1       | 2023-09-03   | Revert Wrong Bugfix.                                   |
| 2.1.2       | 2023-09-03   | Bugfix doubled token update.                           |
| 2.2.0       | 2023-10-28   | Generalization to use extension in 11 & 12, bugfixes.  |
| 2.2.1       | 2023-10-29   | Add typo3 rendered documentation.                      |
| 2.3.0       | 2023-10-31   | Add simple token overview for admins,Counter bugfix    |

## Links

|                 | URL                                                   |
|-----------------|-------------------------------------------------------|
| **Repository:** | https://github.com/kuhschnappel/authtoken             |
| **Packagist:**  | https://packagist.org/packages/kuhschnappel/authtoken |
| **TER:**        | https://extensions.typo3.org/extension/authtoken      |
| **PayPal:**     | https://paypal.me/kuhschnappel                        |

## Support

If you would like to support the project, please consider buying me a coffee.

<a href="https://www.buymeacoffee.com/kuhschnappel" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a>

Best regards - Mike Zimmer - Kuhschnappel / Saxony