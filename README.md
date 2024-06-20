# Nova Nested Inputs

Nova Nested Fields is a [Laravel Nova](https://nova.laravel.com "Laravel Nova") field package that allows users to present their **checkboxes** or **radio** buttons in a nested, hierarchical structure. This package supports infinite nesting levels, providing a flexible solution for complex form requirements.

## Requirements

- `php: >=7.3`
- `laravel/nova: ^4.26`

## Demo

##### Nested radios input
![Nested radio input](https://hosnyben.me/images/ezgif-4-585ec047bc.gif "Nested radio buttons")


##### Nested radios input
![Nested checkbox input](https://hosnyben.me/images/ezgif-4-0e1df527fe.gif "Nested radio buttons")

## Features
- Infinite nesting of checkbox/radio fields.
- Easy integration with existing Laravel Nova projects.
- Customizable display and styling options.
- Supports dynamic addition and removal of nested items.
- Intuitive user interface for managing nested selections.

## Installation 
To install the Nova Nested Fields package, use Composer:
```bash
# Install nova-settings
composer require hosnyben/nova-nested-inputs
```

## Usage

Now you can use the **NovaNestedInputs** Field with [Nova](https://nova.laravel.com "Nova"). Make the **NovaNestedInputs** in the `fields` method like any other field in a `Resource`.

###### Example

```php
// in a Nova Resource

use HosnyBEN\NovaNestedInputs\NovaNestedInputs;

public function fields(Request $request)
{
    return [
            NovaNestedInputs::make('Category', 'category_id')
                ->options(function() {
                    return [
                        ['id' => 1, 'label' => 'Parent 1'],
                        ['id' => 2, 'label' => 'Parent 2'],
                        ['id' => 3, 'label' => 'Parent 3'],
                        [
                            'id' => 4,
                            'label' => 'Parent 4',
                            'children' => [
                                ['id' => 5, 'label' => 'Child 4.1'],
                                [
                                    'id' => 6, 
                                    'label' => 'Child 4.2',
                                    'children' => [
                                        ['id' => 8, 'label' => 'Child 4.2.1'],
                                        ['id' => 9, 'label' => 'Child 4.2.2'],
                                    ],
                                ],
                                ['id' => 7, 'label' => 'Child 4.3'],
                            ],
                        ],
                    ];
                })
                ->type('radio')
                ->color('#be860f')
                ->rules('required'),
    ]
}
```

#### Settings
| Option  | Type  | Description  | Default  |
| :------------ | :------------ | :------------ | :------------ |
| **type**  | String  | You define either a `checkbox` or `radio`  | `radio` |
| **color**  | String  | You define the CSS supported color. It may be a `hex color` or `rgb()` or `rgba()`  | `#be860f`  |
| **options**  | **function()** or multi-dimensional **Array[]**. It must respect the payload.   | You can define infinte loop of nested items. You may use a function if you're looking to load dynamic values of load your Eloquent model into.  | `array()` |

##### "options" field structure
```php
[
	[
		'id' => 1, // ID of the record
		'label' => 'My item', // String : Title of the item
		'disabled' => false, // Boolean
		'children' => [ // Array of nested item with the exact structure
			...
		]
    ],
    ...
]
```

## License

**Nova Nested Inputs** is open-sourced software licensed under the [MIT license](LICENSE.md).

## Author
![Hosny BEN](https://hosnyben.me/images/hb-white-outline-web.png "Hosny BEN")
Made with ❤️ by [Hosny BEN](https://hosnyben.me "Hosny BEN")