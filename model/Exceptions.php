<?php

namespace model;

class UserNameToShortException extends \Exception {}
class PasswordIsToShortException extends \Exception {}
class PasswordDidNotMatchException extends \Exception {}
class UserAllReadyExistException extends \Exception {}
class UserHasInvalidCharacters extends \Exception {}
class UsernameAndPasswordEmpty extends \Exception {}