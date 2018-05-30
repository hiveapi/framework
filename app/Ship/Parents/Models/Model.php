<?php

namespace App\Ship\Parents\Models;

use HiveApi\Core\Abstracts\Models\Model as AbstractModel;
use HiveApi\Core\Traits\HashIdTrait;
use HiveApi\Core\Traits\HasResourceKeyTrait;

/**
 * Class Model.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Model extends AbstractModel
{

    use HashIdTrait;
    use HasResourceKeyTrait;

}
