<?php

require __DIR__.'/vendor/autoload.php';

use Kambo\WebAssembly\Exception\WasmerException;
use Kambo\WebAssembly\Collection;
use Kambo\WebAssembly\Value;
use Kambo\WebAssembly\Native\WasmerFFI;
use Kambo\WebAssembly\Engine;
use Kambo\WebAssembly\Store;
use Kambo\WebAssembly\Module;
use Kambo\WebAssembly\Instance;

// 1) Create an Engine & Store
$engine = new Engine();
$store  = new Store($engine);

// 2) Convert a WAT string to raw WASM
$wat = '(module
    (type $sum_t (func (param i32 i32) (result i32)))
    (func $sum_f (type $sum_t) (param $x i32) (param $y i32) (result i32)
    local.get $x
    local.get $y
    i32.add)
    (export "sum" (func $sum_f)))';

$wasmBytes = WasmerFFI::watToWasm($wat);

// 3) Create a Module
$module = new Module($store, $wasmBytes);

// 4) Instantiate the Module
$instance = new Instance($store, $module);

// 5) Create a Collection of arguments
$args = new Collection([
    Value::i32(10),
    Value::i32(32)
]);


// 6) Call "sum" with the Collection
$results = $instance->callFunction('sum', $args);

if (count($results) !== 1) {
    throw new WasmerException("Expected exactly 1 result from sum!");
}

$sumResult = $results[0]->asI32();
echo "sum(10, 32) = $sumResult\n"; // should print 42

// You can also iterate over results:
foreach ($results as $result) {
    echo "Result: " . $result->asI32() . "\n";
}
