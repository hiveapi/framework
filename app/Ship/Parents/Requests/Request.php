<?php

namespace App\Ship\Parents\Requests;

use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Abstracts\Requests\Request as AbstractRequest;

/**
 * Class Request
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Request extends AbstractRequest
{

    /**
     * If no custom Transporter is set on the child this will be default.
     *
     * @var string
     */
    protected $transporter = DataTransporter::class;
}
