# OpusDNS PHP client

The official PHP client for the [OpusDNS API](https://developers.opusdns.com/): domain registration, transfers,
renewals, contacts, DNS zones, email and domain forwarding, and everything else the API offers. The client is
generated from the OpenAPI specification published in [OpusDNS/api-spec](https://github.com/OpusDNS/api-spec),
so every operation, model and enumeration of the API is available with full type information.

## Requirements

- PHP 8.3 or newer
- A PSR-18 HTTP client and PSR-17 factories. [Guzzle](https://docs.guzzlephp.org/) is used automatically when
  it is installed.
- An OpusDNS API key

## Installation

```bash
composer require opusdns/php-client guzzlehttp/guzzle
```

Leave out `guzzlehttp/guzzle` if you provide your own PSR-18 client.

## Quick start

```php
use OpusDNS\Client\Client;
use OpusDNS\Client\Config;
use OpusDNS\Client\Enum\PeriodUnit;
use OpusDNS\Client\Enum\RenewalMode;
use OpusDNS\Client\Model\ContactHandle;
use OpusDNS\Client\Model\DomainCreate;
use OpusDNS\Client\Model\DomainPeriod;
use OpusDNS\Client\Model\Nameserver;

$client = Client::create(Config::sandbox('opk_your_api_key'));

// Is the name available?
$check = $client->domain()->eppCheckDomain(['example.com']);
if (!$check->results[0]->available) {
    exit('taken');
}

// Register it for one year with an existing contact.
$domain = $client->domain()->createDomain(new DomainCreate(
    contacts: ['registrant' => [new ContactHandle('contact_01h45ytscbebyvny4gc8cr8ma2')]],
    name: 'example.com',
    period: new DomainPeriod(PeriodUnit::Y, 1),
    renewalMode: RenewalMode::EXPIRE,
    nameservers: [new Nameserver('ns1.example.net'), new Nameserver('ns2.example.net')],
));

echo $domain->expiresOn?->format('Y-m-d');
```

Use `Config::production()` for the live API.

## Configuration

```php
use OpusDNS\Client\Client;
use OpusDNS\Client\Config;

$config = new Config(
    apiKey: 'opk_...',
    baseUrl: Config::PRODUCTION_URL,      // or Config::SANDBOX_URL
    userAgent: 'my-billing-app/2.0',      // defaults to the client token
    headers: ['X-Request-Source' => 'billing'],
    timeout: 30.0,                        // seconds, applied when Client::create() builds Guzzle
    connectTimeout: 5.0,
    clientToken: 'my-billing-app/2.0',    // sent as X-OpusDNS-Client; '' omits the header
);

// Guzzle, built by the client
$client = Client::create($config);

// Any PSR-18 client with PSR-17 request and stream factories
$client = new Client($config, $psr18Client, $requestFactory, $streamFactory);
```

`Config::production($apiKey)` and `Config::sandbox($apiKey)` are shortcuts for the two environments.

Every request carries the header `X-OpusDNS-Client: opusdns-php-client/<version>`.

## Services

The API is grouped into services, one per tag of the specification. Each service is reached through an accessor
on the client and has one method per operation, named after the operation id.

| Accessor | Service | Covers |
|---|---|---|
| `$client->domain()` | `DomainService` | Registration, transfer, renewal, restore, update, deletion, availability checks, claims notices, DNSSEC at the registry, TLD-specific procedures |
| `$client->contact()` | `ContactService` | Registrant and other contacts, verification, attribute sets |
| `$client->availability()` | `AvailabilityService` | Bulk and streamed availability lookups |
| `$client->domainSearch()` | `DomainSearchService` | Name suggestions |
| `$client->tld()` | `TldService` | TLD specifications and portfolio |
| `$client->host()` | `HostService` | Host objects (glue records) |
| `$client->dns()` | `DnsService` | DNS zones, record sets, DNSSEC signing, zone summaries |
| `$client->vanityNameservers()` | `VanityNameserversService` | Vanity nameserver sets |
| `$client->domainForward()` | `DomainForwardService` | HTTP redirects |
| `$client->emailForward()` | `EmailForwardService` | Email forwarding |
| `$client->parking()` | `ParkingService` | Domain parking |
| `$client->jobs()` | `JobsService` | Asynchronous jobs and batches |
| `$client->event()` | `EventService` | Event history |
| `$client->tag()` | `TagService` | User tags |
| `$client->archive()` | `ArchiveService` | Archived objects |
| `$client->report()` | `ReportService` | Reports and downloads |
| `$client->organization()` | `OrganizationService` | Organization, credentials, pricing, billing |
| `$client->user()` | `UserService` | Users of the organization |
| `$client->whitelabel()` | `WhitelabelService` | White-label branding |
| `$client->authentication()` | `AuthenticationService` | Token and credential introspection |
| `$client->aiConcierge()` | `AiConciergeService` | AI concierge conversations |

A few examples:

```php
$domain = $client->domain()->getDomain('example.com');

$renewal = $client->domain()->renewDomain('example.com', new DomainRenewRequest(
    currentExpiryDate: new \DateTimeImmutable('2027-01-31T10:00:00Z'),
    period: new DomainPeriod(PeriodUnit::Y, 1),
));
echo $renewal->newExpiryDate->format('Y-m-d');

$client->domain()->transferDomain(new DomainTransferIn('example.org', RenewalMode::RENEW, authCode: 'epp-code'));

$client->domain()->updateDomain('example.com', new DomainUpdate(renewalMode: RenewalMode::RENEW));

$contact = $client->contact()->createContact(new ContactCreate(
    city: 'Berlin', country: 'DE', disclose: false, email: 'jane@example.com',
    firstName: 'Jane', lastName: 'Doe', phone: '+49.301234567', postalCode: '10115', street: 'Unter den Linden 1',
));

$zone = $client->dns()->getZone('example.com');
$client->dns()->patchZoneRrsets('example.com', new DnsZoneRrsetsPatchOps([
    new DnsRrsetPatchOp(PatchOp::UPSERT, new DnsRrsetPatch('www.example.com.', [['rdata' => '192.0.2.1']], 3600, DnsRrsetType::A)),
]));
```

Method parameters follow the specification: path parameters first, then required query parameters and the
request body, then optional query parameters. Optional parameters left at `null` are not sent. Named arguments
keep calls readable:

```php
$page = $client->domain()->getDomains(search: 'example', expiresIn30Days: true, pageSize: 50);
```

## Models

Every request and response schema is a `final readonly class` in `OpusDNS\Client\Model`, and every enumeration
is a backed `enum` in `OpusDNS\Client\Enum`.

- Properties are public and camelCase: `$domain->expiresOn`, `$zone->dnssecStatus`. The JSON keys stay
  snake_case and are mapped by `fromArray()` and `toArray()`.
- Construct request models with named arguments. Required fields come first and have no default; optional fields
  default to `null` or to the default the specification declares.
- Every service method that takes a body accepts either the model or a plain array with the JSON field names.
- Models implement `JsonSerializable`, so `json_encode($domain)` and framework JSON responses produce the API's
  own shape.
- `toArray()` omits properties that are `null`. `new DomainUpdate(authCode: null)` therefore leaves the auth code
  untouched. To send an explicit `null`, pass a plain array: `updateDomain('example.com', ['auth_code' => null])`.
- Enumerated fields are typed as the enum or its raw value, for example `RenewalMode|string`. Known values
  hydrate to the enum case, so `$domain->renewalMode === RenewalMode::EXPIRE` works; a value this version of
  the client does not know is kept as the raw string, so `match` expressions need a default arm.
- Timestamps are `\DateTimeImmutable` objects; they are sent as UTC RFC 3339 strings with a `Z` suffix.
  Date-only fields are `\DateTimeImmutable` objects at midnight UTC and are sent as `YYYY-MM-DD`, whatever the
  process timezone.
- Nested objects are models, lists are PHP lists and maps are string-keyed arrays, all documented with generic
  types in the constructor docblock. An empty map is sent as `{}`.
- Schemas that are a union of objects become PHP union types. The client resolves them with the discriminator the
  specification declares, or by matching required keys when there is none.

## Pagination

Listing methods return a page model that implements `Page`: `results()` gives the items of that page and
`pagination()` the metadata (`currentPage`, `totalPages`, `totalItems`, `hasNextPage`). `Paginator` walks all
pages by calling your closure with successive page numbers.

```php
use OpusDNS\Client\Paginator;

$expiring = Paginator::items(fn (int $page) => $client->domain()->getDomains(page: $page, pageSize: 100, expiresIn30Days: true));

foreach ($expiring as $domain) {
    echo $domain->name, ' expires ', $domain->expiresOn?->format('Y-m-d'), "\n";
}

foreach (Paginator::pages(fn (int $page) => $client->dns()->listZones(page: $page), maxPages: 5) as $number => $page) {
    echo "page {$number} of {$page->pagination()->totalPages}\n";
}
```

Iteration stops when the API reports no further page, when the last page number is reached, when a page comes
back empty, or after `maxPages` pages.

## Errors

All exceptions extend `OpusDNS\Client\Exception\OpusDnsException`, which extends `RuntimeException`.

| Exception | Raised when |
|---|---|
| `NetworkException` | No response arrived: DNS, TLS, connection or timeout failure |
| `HttpException` | The API answered with a 4xx or 5xx status |
| `BadRequestException` | 400 |
| `UnauthorizedException` | 401, usually a missing or invalid API key |
| `ForbiddenException` | 403, the key lacks a required permission |
| `NotFoundException` | 404 |
| `ConflictException` | 409, for example registering a name that is already registered |
| `ValidationException` | 422; `messages()` lists the failing fields as `field.path: message` |
| `RateLimitException` | 429; `retryAfter()` gives the seconds to wait when the API sends `Retry-After` |
| `ServerException` | Any 5xx |
| `DecodingException` | A successful response could not be decoded or hydrated into its model |

The status exceptions extend `HttpException`, which exposes `statusCode()`, the problem details the API sends
(`problemType`, `problemTitle`, `problemDetail`), the decoded `body`, and the PSR-7 `request` and `response`.
The stored request carries no `X-Api-Key` header.

```php
use OpusDNS\Client\Exception\ConflictException;
use OpusDNS\Client\Exception\HttpException;
use OpusDNS\Client\Exception\NetworkException;
use OpusDNS\Client\Exception\ValidationException;

try {
    $client->domain()->createDomain($request);
} catch (ValidationException $e) {
    foreach ($e->messages() as $message) {
        echo $message, "\n";
    }
} catch (ConflictException $e) {
    echo $e->problemDetail;
} catch (HttpException $e) {
    echo $e->statusCode(), ' ', $e->problemTitle;
} catch (NetworkException $e) {
    // retry later
}
```

## Testing your integration

`OpusDNS\Client\Testing\FakeHttpClient` is a PSR-18 client that records requests and answers from a queue, so
code using this client can be tested without the network:

```php
use OpusDNS\Client\Config;
use OpusDNS\Client\Testing\FakeHttpClient;

$http = new FakeHttpClient();
$client = $http->client(Config::sandbox('test-key'));

$http->queueJson(200, ['name' => 'example.com', 'roid' => 'D1-OPUS', 'sld' => 'example', 'tld' => 'com']);
$domain = $client->domain()->getDomain('example.com');

$http->lastRequest()->getUri();   // https://sandbox.opusdns.com/v1/domains/example.com
$http->requests;                  // every request sent so far
```

`queue()` accepts any PSR-7 response or a throwable to simulate a transport failure. An empty queue answers
`200` with an empty JSON object.

## Lower-level access

`Client::request()` sends any request with the configured authentication and returns the PSR-7 response.
`Endpoint` holds every path template of the API, and `Permission::required()` tells which permissions the API
key needs for an operation.

```php
use OpusDNS\Client\Endpoint;
use OpusDNS\Client\Permission;

$response = $client->request('GET', Endpoint::DOMAINS_BY_DOMAIN_REFERENCE, path: ['domain_reference' => 'example.com']);
$data = $client->decodeArray($response);

Permission::required('POST', Endpoint::DOMAINS); // ["domains:manage"]
```

## Development

### Layout

| Path | Contents |
|---|---|
| `src/Client.php`, `Config.php`, `Serializer.php`, `Union.php`, `Paginator.php`, `ApiModel.php`, `src/Exception/` | Hand-written runtime |
| `src/Model/`, `src/Enum/`, `src/Service/`, `src/Endpoint.php`, `src/Permission.php` | Generated from the specification; each file says so in its header |
| `generator/` | The generator, built on [nette/php-generator](https://github.com/nette/php-generator); a development dependency only |
| `spec/openapi.yaml` | The specification the generated code was produced from |
| `spec/version.yaml` | The api-spec commit and version that specification was taken from |
| `tests/` | PHPUnit tests, including a fixture specification that exercises the generator end to end |

### Examples

`examples/` holds scripts that run against the sandbox and print what happens: registering, renewing and updating
a domain. They read the key from the `OPUSDNS_API_KEY` environment variable or from a `.env` file in the
repository root; copy `.env.example` to `.env` and fill in a sandbox key.

```bash
php examples/register-domain.php
php examples/renew-domain.php opusdns-php-client-1234abcd.com
php examples/update-domain.php opusdns-php-client-1234abcd.com
```

### Commands

```bash
composer install
composer spec:check   # is spec/openapi.yaml behind api-spec?
composer spec:sync    # fetch the latest specification (or: bin/spec-sync --ref <commit>)
composer generate     # regenerate src/ from spec/openapi.yaml
composer test         # PHPUnit
composer stan         # PHPStan over src and generator
```

### Updating to a new specification

Run `composer spec:sync`, then `composer generate`, `composer test` and `composer stan`, and review the diff of
`src/`. New operations, models and enum values appear automatically; removed or renamed ones are a breaking
change for consumers. Regenerate whenever the API adds enum values: hydration is strict, so a client built from
an older specification keeps values it has never seen as raw strings.

The "Spec update" workflow does the same on a weekly schedule and on manual runs: it syncs the specification,
regenerates, runs the checks and opens a pull request when anything changed. The "CI" workflow verifies on every
push and pull request that `src/` matches the committed specification and that the checks pass.

### Releasing

Merging a pull request into `main` releases: the "Release" workflow runs the checks, bumps the version from the
latest tag, pushes the new tag and creates the GitHub release with generated notes. The pull request's label
picks the bump: `major`, `minor` or `patch`, with `patch` when no label is set; a `no-release` label skips the
release. The same workflow can be run by hand with the bump chosen from a dropdown. Packagist picks the tag up
through its GitHub hook.

### How the generator maps the specification

| Specification | PHP |
|---|---|
| Object schema | `final readonly class` with promoted public properties, `fromArray()` and `toArray()` |
| Enum schema | Backed `enum`; case names are upper snake case, values starting with a digit get a leading underscore |
| `anyOf` with `null` | Nullable type |
| Union of objects | PHP union type, resolved by discriminator or by required keys |
| `array`, `additionalProperties` | `array`, documented as `list<T>` or `array<string, T>` |
| `date-time`, `date` | `\DateTimeImmutable` |
| `default`, `const` | Constructor default values |
| Operation | Method on the tag's `Service\*Service` class, named from the operation id |
| Path | Constant on `Endpoint` |
| `x-required-permissions` | `Permission::REQUIRED` and a line in the method docblock |

## License

Released under the MIT License. See [LICENSE](LICENSE) for the full text.
