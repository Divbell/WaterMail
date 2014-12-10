<?php
/**
 * A route collection class
 */

namespace library\Routing;

use library\Collection\Collection as Collection;

class RouteCollection extends Collection
{
    public function addItem(Route $route, $key = null)
    {
        parent::addItem($route, $key);
    }
}