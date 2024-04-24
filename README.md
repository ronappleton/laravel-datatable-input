# Laravel Datatable Input

This package is a simple package to handle the input of the datatable in Laravel.

## Installation

You can install the package via composer:

```bash
composer require ronappleton/laravel-datatable-input
```

## Usage

This package comes with 4 classes that you can use to handle the input of the datatable.

### RequestInput

This class is used to handle the input of the request. It gives access to the components of the datatable input.

```php
use RonAppleton\LaravelDatatableInput\RequestInput;

$requestInput = new RequestInput($request);

int|null $requestInput->draw(); // The draw counter that this object is a response to - from the draw parameter sent as part of the data request.
int|null $requestInput->start(); // Paging first record indicator. This is the start point in the current data set (0 index based - i.e. 0 is the first record).
int|null $requestInput->length(); // Number of records that the table can display in the current draw.

Search $requestInput->search(); // Global search value. To be applied to all columns which have searchable as true.
Order[] $requestInput->order(); // Column ordering (used for sorting).
Column[] $requestInput->columns(); // Column data source objects for the table.
```

### Search

This class is used to handle the search input of the request.

```php
use RonAppleton\LaravelDatatableInput\Search;

$search = new Search($search);

string $search->value(); // Global search value.
bool $search->regex(); // true if the global filter should be treated as a regular expression for advanced searching, false otherwise.
```

### Order

This class is used to handle the order input of the request.

```php
use RonAppleton\LaravelDatatableInput\Order;

int $order->column(); // Column to which ordering should be applied. This is an index reference to the columns array of information that is also submitted to the server.
string $order->dir(); // Ordering direction for this column. It will be asc or desc to indicate ascending ordering or descending ordering, respectively.
```

### Column

This class is used to handle the column input of the request.

```php
use RonAppleton\LaravelDatatableInput\Column;

string $column->data(); // Column's data source, as defined by columns.data.
string $column->name(); // Column's name, as defined by columns.name.
bool $column->searchable(); // Flag to indicate if this column is searchable (true) or not (false).
bool $column->orderable(); // Flag to indicate if this column is orderable (true) or not (false).
Search $column->search(); // Search value to apply to this specific column.
```

### Example

```php
use RonAppleton\LaravelDatatableInput\RequestInput;

public function index(Request $request)
{
    $requestInput = new RequestInput($request);

    $draw = $requestInput->draw();
    $start = $requestInput->start();
    $length = $requestInput->length();
    $search = $requestInput->search();
    $order = $requestInput->order();
    $columns = $requestInput->columns();

    // Your code here
}
```

## Testing

```bash
composer test # or ./vendor/bin/phpunit
composer stan # or ./vendor/bin/phpstan analyse
```
