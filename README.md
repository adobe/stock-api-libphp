# Stock API libphp

## Overview
This is a PHP implementation of the various APIs provided by the Stock services.


## Getting Started
This is a composer project. Following steps are needed for getting started with this project:

### Setup
Run `composer install --no-dev` for installing the required libraries.
If you plan to do some developement, then remove the `--no-dev` option

### Tests
Run `composer run check` for linting and testcases.
Run `composer run test-coverage` for test coverage.

The above command will by default run the linting, test cases and the code coverage along with building the project. The linting results will be shown within the console output itself and if there are any issues the build will stop and fail instantly. If there are no linting issues found, the build will continue to build the project. It will also generate the detailed coverage reports for you.
* The coverage report can be found at `<project directory>/data/clover/index.html`
Note - Since the test and coverage steps come later in the build process than linting, so if linting fails, you won't get the coverage reports.

### Lint with PHP_CodeSniffer
This project uses PHPCS for linting. 

Linting checks are enforced with the build step itself. By default, the linting will run first and if there are any issues the build will fail. 

### Running Test Suites
However, the `composer run check` will run the tests automatically but if you need to run the tests separately, please run the below command in console -
```
`composer run test`
```
### Coverage
Just run the `composer run test-coverage` as mentioned above, it should generate the coverage reports along with the test results and building the project. As mentioned above coverage reports can be found at 
`<project directory>/data/clover/index.html`

## Integration Guide
To start using PHP SDK, you need to add `PHPSDK-[version]` into your project build path. You can download the source code and compile locally with composer command as mentioned in the Getting Started section above to generate the latest `PHPSDK-[version]`. 

When you build the project, you will find the dependency  in the `vendor` folder. If these are not already in your environment, you'll need to add them to your build path. Below is the list of dependent jars -
* `guzzlehttp-[version]`
* `phpcbf-[version]`
* `phpcs-[version]`
* `phpunit-[version]`

## Usage
### AdobeStock
In order to use the Stock APIs, one must initialize `AdobeStock` by passing config values like `ApiKey`, `Product`, `environment` which in turn initializes  stock `Config`.

``` PHP

    $client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'STAGE', new Http());

```

### Accessing SearchCategory
#### SearchCategory
`AdobeStock` class allows you to access the Search/Category and Search/CategoryTree Stock APIs. Each stock asset is placed into a category that classifies the asset, such as "Travel" or "Hobbies and Leisure" and each category has a unique identifying number, a name, and a path that you can use to access other assets in the same category.

 You can construct the `SearchCategoryRequest` object to set category identifier and locale information. Then you can call `searchCategory` method to get information about a category of stock assets in the form of `SearchCategoryResponse` object. You can also call `searchCategoryTree` method to retrieve information for zero or more category identifiers in the form of list of `SearchCategoryResponse` object.

##### Instantiation
You can construct the object of this class with below arguments -

* Requires:
    `config` - the stock configuration object of `Config` type.
   
* Returns:
    `SearchCategoryResponse` - The response object containing the search category API results matching the request object returned by `searchCategory` method.
    `List of SearchCategoryResponse` - The list of response object containing the search category tree API results matching the request object returned by `searchCategoryTree` method.
   

##### Example
Sample code to instantiate the SearchCategory API -

``` PHP

        //Instantiating and Initializing AdobeStock
        $client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'STAGE', new Http());
        //Users ims token
        $access_token = 'ims_token';

        //Constructing SearchCategoryRequest
        $request = new SearchCategoryRequest();
        $request->setCategoryId(1043)->setLocale('En-US');

        //Now you can call searchCategory to get category information
        $response = $client->searchCategory($request, $access_token);
        //You can also call searchCategoryTree to get information about list of categories
        $response = $client->searchCategoryTree($request, $access_token);

```
##### Methods
* `AdobeStock` class methods can throw StockApiException if request is not valid or API returns with an error. It allows you to -
   * `searchCategory` - Method to get information about a category of Stock assets, such as travel or animals for a specified category identifier, optionally localized. You need to pass `SearchCategoryRequest` object containing category identifier and locale(optional) parameters. If the request object is not valid or API returns with error, the method will throw the `StockApiException`.

   * `searchCategoryTree` - Method to get category information for zero or more category identifiers. You need to pass `SearchCategoryRequest` object containing category identifier and locale parameters (both optional). If request object does not contain category identifier, this returns a list of all stock categories. If the request object is not valid or API returns with error, the method will throw the `StockApiException`.

#### SearchCategoryRequest
In order to make SearchCategory/SearchCategoryTree API call, you need to create a `SearchCategoryRequest` object to define the search criterion for search category results. You can set category identifier and location language code supported by Stock Search Category/Category Tree API here.

Here is the mapping of Search Category/CategoryTree API query parameters with the setters methods that you can use to set the corresponding parameters in PHP Stock SDK -

|API URL Query Parameter| Setter Methods in SearchCategoryRequest |Description|
|---|---|---|
|locale|setLocale|Sets location language code. For e.g. "en-US", "fr-FR" etc.|
|category_id|setCategoryId|Sets unique identifier for an existing category for e.g 1043|

#### SearchCategoryResponse
It represents the search result returned from Stock Search/Category API. The `AdobeStock` class methods for e.g. `searchCategory` returns the object of `SearchCategoryResponse` initialized with the results returned from the Search/Category API.
`SearchCategoryResponse` allows you to -
* `getName` - Get localised name of the category returned by search/category API
* `getId` - Get unique identifier of the category returned by search/category API
* `getLink` - Get path of the category returned by search/category API

