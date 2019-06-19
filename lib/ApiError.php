<?php
namespace Couch;

class APIError extends \Exception {}

# HTTP Status 400
class BadRequest extends APIError {}
class CredentialsMissing extends BadRequest {}
class BadEnvironment extends BadRequest {}

# HTTP Status 401
class Unauthorized extends APIError {}
class BadCredentials extends Unauthorized {}

# HTTP Status 404
class NotFound extends APIError {}
class PageNotFound extends NotFound{}
class ChargeNotFound extends NotFound {}
class WithdrawalNotFound extends NotFound {}

# HTTP Status 429
class RateLimitException extends APIError {}

# HTTP Status 500
class InternalServerError extends APIError {}
