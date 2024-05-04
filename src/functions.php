<?php

namespace SaKanjo\FilamentFakeFillAction;

function isFakeFilling(): bool
{
    return app('fakeFilling');
}
