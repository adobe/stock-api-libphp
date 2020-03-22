# Stock API libphp

## Overview
This is a PHP implementation of the various APIs provided by the Stock services. Adobe Stock APIs are available [here](https://www.adobe.io/apis/creativecloud/stock/docs/getting-started.html)


## Getting Started
   1. Use Git to clone the entire repository in the root folder, or export a zip of the repository and extract locally.
   2. Or, you can include this repository into your project using composer by adding the following configuration into your composer.json file:

```JSON
    {
        "require-dev": {
            "astock/stock-api-libphp": "dev-master"
        },
        "repositories": [
            {
                "type": "vcs",
                "url": "git@github.com:adobe/stock-api-libphp.git"
            }
        ]
    }
```
   3. Or, you can refer to [AdobeStock Sample For SDK](https://github.com/adobe/stock-api-samples/tree/master/php) to use this SDK in your project in a very handy way.

### Prerequisites
To use the SDK you need to check for the following prerequisites:

  1. The SDK requires PHP 7.1 or higher. If you do not have that version, install it now.

  2. If Composer isn't already installed, install it from  [here](https://getcomposer.org/download/). This is required to download project dependencies for the SDK.

        * For Mac, recommend Homebrew for this:
            * Run `brew install composer`.
            * If you get a message that the lock file is out of date, run `brew update composer`.
  
### Build Steps
  * Run `composer update` to update the composer.lock file to install new dependencies.
  * Run `composer install --no-dev` for installing the required libraries.

    If you plan to do some developement, then remove the `--no-dev` option If you choose to install those extra dependencies, you must also install [xdebug](https://xdebug.org/) separately or use following steps.
    * On Mac use homebrew to install xdebug:
        * Use `brew search xdebug` to get the list of available xdebug extensions.
        * From the above list, pick latest xdebug version and run `brew install homebrew/php/<php-version>-xdebug`
            ex: `brew install homebrew/php/php71-xdebug`.
            
    * On Windows, use following steps to install xdebug :
        * Download xdebug.dll from [here](https://xdebug.org/download.php).
        * Edit php.ini to use xdebug extension. Steps given [here](https://docs.joomla.org/Edit_PHP.INI_File_for_XDebug).
           

## Usage
### AdobeStock
In order to use the Stock APIs, one must initialize `AdobeStock` by passing config values like `ApiKey`, `Product`, `environment` which in turn initializes  stock `Config`.

``` PHP

    $client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', new Http());

```
|Environment|Description|
|---|---|
|STAGE|Uses internal staging environment.Mainly used for testing purposes|
|PROD|Used in development purposes.|
### Accessing SearchFiles
#### SearchFiles
`AdobeStock` class will allow you to access the Search/Files Stock Api. You can query Adobe Stock for assets that meet your specified search criteria. You can construct the `SearchFilesRequest` object to set filters, sort order, set search keywords etc. for the Search/Files api.

First, You have to call `searchFilesInitialize` to initialize search files which will gives you adobe stock object from where you can call `getNextResponse`, `getPreviousResponse` etc. to fetch the results.
The `AdobeStock` provides paginated interface which allows you to call its methods (for e.g. `getNextResponse`, `getPreviousResponse` etc.) multiple times to retrieve the subsequent search results in order. It maintains the current state of searchFiles request and initially, the state is pointing invalid search files results. As soon as, the `getNextReponse` method is called, it makes Search/Files api call and returns the results with `SearchFilesReponse` object. The `getNextResponse` moves the state to next page and fetch the response for the same. Similarly, the `getPreviousResponse` and `getResponsePage` methods can be used to move one page behind and skip to a particular search page index respectively.

##### Instantiation
You can construct the object of this class with below arguments -
* Requires:
    * `access_token` - the adobe ims user access token. It must be a valid access token if is_licensed result column is requested with the results. Otherwise, it can be null.
    * `request` - the request object of `SearchFilesRequest` consisting the locale, results column, search parameters etc.

* Returns:
    * The response object (`SearchFilesResponse`) containing the search files api results matching the request object.

##### Example
Sample code to initialize the SearchFiles Api -

``` PHP
        $results_columns = Constants::getResultColumns();
        $search_params = new SearchParameters();
        $search_params->setWords('tree')->setLimit(3)->setOffset(0);
        
        $result_column_array = [
            $results_columns['NB_RESULTS'],
            $results_columns['COUNTRY_NAME'],
            $results_columns['ID'],
        ];
        
        $request = new SearchFilesRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($search_params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $response = $this->_adobe_stock_client->searchFilesInitialize($request, '');

```
More examples can be found at the end of this document.

##### Methods
* `AdobeStock` Methods for file searchcan throw StockException if there are no search results available. It allows you to -
    * `getNextResponse` - Method to get next search files response page. It moves the state to next page and fetch the searchFiles response for the same. If the api returns with error or if there are no more search results available for the search request, the method will throw the StockException.
    
    * `getPreviousResponse` -  Method to get previous search files response page. It moves the state to previous page and fetch the searchFiles response for the same. If the api returns with error or if there are no more search results available for the search request or the state is pointing to invalid state, the method will throw the StockException.
    
    * `getResponsePage` - Method to skip to a specific search files response page. It moves the state to provided search page and fetch the searchFiles response for the same. It will throw StockException if there is any failure while searchFiles api or if the provided search page index is out of total search pages available.
    
    * `getLastResponse` -  Get the response object of recently performed searchFiles api call either by using `getNextReponse` or `getPreviousResponse` or `getResponsePage`. Initially, this method will return null since it is pointing to invalid state and no response available at this point.
    
    * `currentSearchPageIndex` - Get the current search page index of searchFiles response available from recently performed `getNextReponse` or `getPreviousResponse` or `getResponsePage` method. Initially, since the state is pointing to invalid state, it returns -1.
    
    * `totalSearchPages` - Get the total number of search pages available from recently performed `getNextReponse` or `getPreviousResponse` or `getResponsePage` method. Initially, since the state is pointing to invalid state, it returns -1.
    
    * `totalSearchFiles` - Get the total number of search files available from recently performed `getNextReponse` or `getPreviousResponse` or `getResponsePage` method. Initially, since the state is pointing to invalid state, it returns -1.


#### SearchFilesRequest
In order to make SearchFiles API call, you need to create a SearchFileRequest object to define the search criterion for search files results. You can set the various search parameters, locale and required result columns supported by Stock Search/Files api here.

Here is the mapping of Search/Files api query parameters with the setters methods that you can use to set the corresponding parameters in PHP Stock SDK -

|API URL Query Parameter| Setter Methods in SearchFilesRequest |Description|
|---|---|---|
|locale|setLocale|Sets location language code. For e.g. "en-US", "fr-FR" etc.|
|search_parameters[*]|setSearchParams|Sets An object of `SearchParameters` where one can set all supported search_parameters|
|similar_image|setSimilarImage| Sets an image data for visual similarity search. It will only be considered if similar image in `SearchParameters` is set to true. |
|result_columns[]| setResultColumns | Allows to set the list of result columns required in the search results. If you are not setting result columns, it will set all default columns in result_column array at api level. For more details, read Result Columns section below.|

#### SearchParameters
`SearchParameters` allows to set the various search_parameters (URL query parameters) supported by Search/Files Stock api. This is the class where you can actually set the search keywords, limit, sort order, filters, media_id etc.

Mapping of query parameter search_parameters[*] with SearchParameters class setter methods -

|Search Parameter| Setter Methods | Description|
|---|---|---|
|search_parameters[words]|setWords|Allows to set the key words that you want to search|
|search_parameters[limit]|setLimit|Allows to set maximum number of assets to return in the call.|
|search_parameters[offset]|setOffset|Allows to set the start position in search results. |
|search_parameters[order]|setOrder|Allows to set sorting order in which it will return found assets|
|search_parameters[creator_id]|setCreatorId|Allows to search by a specific asset creator's ID|
|search_parameters[media_id]|setMediaId|Allows to search for one specific asset by its unique identifier (media_id)|
|search_parameters[model_id]|setModelId|Allows to search for assets that portray a specific person (model) using the model's ID|
|search_parameters[serie_id]|setSerieId|Allows to search for assets in the specified series using the series ID|
|search_parameters[gallery_id]|setGalleryId|Allows to search with a specific galleryId filter|
|search_parameters[similar]|setSimilar|Allows to search for assets that are similar in appearance to an asset with a specific media ID|
|search_parameters[similar_url]|setSimilarURL|Allows to search for assets that are similar in appearance to an image at a specific URL|
|search_parameters[category]|setCategory|Allows to search for assets with a specific category ID|
|search_parameters[thumbnail_size]|setThumbnailSize|Allows to set the size of thumbnail(in pixels) to return for each found asset|
|search_parameters[filters][area_pixels]|setFilterAreaPixels|Allows to set image sizes in pixels for returned assets|
|search_parameters[filters][3d_type_id][]|setFilter3DTypeIds|Allows to set array specifying which 3D types to return|
|search_parameters[filters][template_type_id][]|setFilterTemplateTypes |Allows to set array specifying which template types to return|
|search_parameters[filters][template_category_id][]|setFilterTemplateCategoryIds|Allows to set array specifying which template categories to return|
|search_parameters[filters][has_releases]|setFilterHasReleases|Allows to return only that assets which has model or property releases|
|search_parameters[filters][content_type:photo]|setFilterContentTypePhoto|Allows to include found assets that are photos|
|search_parameters[filters][content_type:illustration]|setFilterContentTypeIllustration|Allows to include found assets that are illustrations|
|search_parameters[filters][content_type:vector]|setFilterContentTypeVector|Allows to include found assets that are vectors|
|search_parameters[filters][content_type:video]|setFilterContentTypeVideo|Allows to include found assets that are videos|
|search_parameters[filters][content_type:3d]|setFilterContentType3D|Allows to include found assets that are 3D items|
|search_parameters[similar_image]|setSimilarImage|Allows to set whether to use similar_image data for visual similarity search|
|search_parameters[filters][content_type:all]|setFilterContentTypeAll|Allows to include found assets of all content_types|
|search_parameters[filters][offensive:2]|setFilterOffensive2|Allows to return found assets only if they are flagged as including Explicit/Nudity/Violence|
|search_parameters[filters][isolated:on]|setFilterIsolatedOn|Allows to return found assets only if the subject is isolated from the background by being on a uniformly colored background|
|search_parameters[filters][panoramic:on]|setFilterPanoromicOn|Allows to return found assets only if they are panoramic|
|search_parameters[filters][orientation]|setFilterOrientation|Allows to return found assets of the specified orientation|
|search_parameters[filters][age]|setFilterAge|Allows to return found assets of the specified age|
|search_parameters[filters][video_duration]|setFilterVideoDuration|Alows to return videos whose duration is no longer than the specified duration in seconds|
|search_parameters[filters][Premium]|setPremium|Allows to return found assets with premium (pricing) level|
|search_parameters[filters][colors]|setFilterColors|Allows to return only found assets that contain the specified colors|
|search_parameters[filters][Editorial]|setFilterEditorial|Allows to return only found assets that are editorial|
|search_parameters[filters][content_type:template]|setFilterContentTypeTemplate|Allows to include found assets that are of template types|

#### Result Columns
You can create array of ResultColumn enums to define columns that you want to include in your search results.

##### Example
```PHP
    $results_columns = Constants::getResultColumns();
    $result_column_array = [
            $results_columns['NB_RESULTS'],
            $results_columns['COUNTRY_NAME'],
            $results_columns['ID'],
        ];
```
##### Note
If you are not setting result columns, it will set following columns in result_column array by default.
* Default Result Columns -
    * `NB_RESULTS`
    * `ID`
    * `TITLE`
    * `CREATOR_NAME`
    * `CREATOR_ID`
    * `WIDTH`
    * `HEIGHT`
    * `THUMBNAIL_URL`
    * `THUMBNAIL_HTML_TAG`
    * `THUMBNAIL_WIDTH`
    * `THUMBNAIL_HEIGHT`
    * `MEDIA_TYPE_ID`
    * `CATEGORY`
    * `CATEGORY_HIERARCHY`
    * `VECTOR_TYPE`
    * `CONTENT_TYPE`
    * `PREMIUM_LEVEL_ID`
#### SearchFilesResponse
It represents the search results returned with Stock Search/Files API. The `SearchFiles` class methods for e.g. `getNextResponse` returns the object of `SearchFilesResponse` initialized with the results returned from the Search/Files api.
SearchFilesResponse allows you to -
* `getNbResults` - Get the value of 'nb_results' column from the search response
* `getFiles` - Get the list of `StockFile` returned by search files api

#### Making a SearchFilesRequest and Calling search files api
These are the complete examples showing how a search request is created and then search api is called, which in turn returns search results in the form of serchFileRequest.
* Example to get search results by calling getNextResponse method:

``` PHP
        $results_columns = Constants::getResultColumns();
        $search_params = new SearchParameters();
        $search_params->setWords('tree')->setLimit(3)->setOffset(0);
        
        $result_column_array = [
            $results_columns['NB_RESULTS'],
            $results_columns['COUNTRY_NAME'],
            $results_columns['ID'],
        ];
        
        $request = new SearchFilesRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($search_params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $search_files_response = $this->_adobe_stock_client->searchFilesInitialize($request, '')->getNextResponse();

```
* Example to get previous search results by calling getPreviousResponse method:

``` PHP
        $results_columns = Constants::getResultColumns();
        $search_params = new SearchParameters();
        $search_params->setWords('tree')->setLimit(3)->setOffset(0);
        
        $result_column_array = [
            $results_columns['NB_RESULTS'],
            $results_columns['COUNTRY_NAME'],
            $results_columns['ID'],
        ];
        
        $request = new SearchFilesRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($search_params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $search_files_response = $this->_adobe_stock_client->searchFilesInitialize($request, '')->getPreviousResponse();
```
* Example to skip to specific page of results by calling getResponsePage method:

``` PHP
        $results_columns = Constants::getResultColumns();
        $search_params = new SearchParameters();
        $search_params->setWords('tree')->setLimit(3)->setOffset(0);
        
        $result_column_array = [
            $results_columns['NB_RESULTS'],
            $results_columns['COUNTRY_NAME'],
            $results_columns['ID'],
        ];
        
        $request = new SearchFilesRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($search_params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $search_files_response = $this->_adobe_stock_client->searchFilesInitialize($request, '')->getResponsePage(10);
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
        $client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', new Http());
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

### Accessing Files Metadata
#### Files
`AdobeStock` class allows you to access the Files Stock APIs. The Files API is used to retrieve metadata from Adobe Stock, either one asset at a time, or in bulk.

 You can construct the `\AdobeStock\Api\Request\Files` object to set identifiers, locale information and desired result columns. Then you can call `getFiles` method to get metadata about the requested file ids in the form of `\AdobeStock\Api\Response\Files` object.

##### Instantiation
You can construct the object of this class with below arguments -

* Requires:
    `config` - the stock configuration object of `Config` type.
   
* Returns:
    `\AdobeStock\Api\Response\Files` - The response object containing the files API results matching the request object, returned by `getFiles` method.

##### Example
Sample code to instantiate the Files API -

``` PHP

        //Instantiating and Initializing AdobeStock
        $client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', new Http());
        //Users ims token
        $access_token = 'ims_token';

        //Constructing SearchCategoryRequest
        $request = new \AdobeStock\Api\Request\Files();
        $request->setIds([105988, 105989, 105990])
                ->setLocale('En-US');
                ->setResultColumns([
                    'id',
                    'title',
                    'creator_name',
                    'description',
                ]);

        //Now you can call getFiles to get files metadata
        $response = $client->getFiles($request, $access_token);

```
##### Methods
* `AdobeStock` class methods can throw StockApiException if request is not valid or API returns with an error. It allows you to -
   * `getFiles` - Method to get metadata information about Stock Files. You need to pass `\AdobeStock\Api\Request\Files` object containing files identifiers, locale(optional) and result_columns(optional) parameters. If the request object is not valid or API returns with error, the method will throw the `StockApiException`.

#### FilesRequest
In order to make GetFiles API call, you need to create a `\AdobeStock\Api\Request\Files` object to define the ids of the files that you are looking for metadata. You can set files identifiers, location language code and result columns supported by Bulk metadata Files API.

Here is the mapping of Files API query parameters with the setters methods that you can use to set the corresponding parameters in PHP Stock SDK -

|API URL Query Parameter| Setter Methods in SearchCategoryRequest |Description|
|---|---|---|
|ids|setIds|Sets an array of files identifiers e.g array(105988)|
|locale|setLocale|Sets location language code. For e.g. "en-US", "fr-FR" etc.|
|result_columns|setResultColumns|Sets an array of requested metadata e.g array('id','title',...)|

##### Note
If you are not setting result columns, it will set following columns in result_columns array by default.
* Default Result Columns -
    * `ID`

#### FilesResponse
It represents the result returned from Files API. The `AdobeStock` class methods for e.g. `getFiles` returns the object of `\AdobeStock\Api\Response\Files` initialized with the results returned from the Files API.
`\AdobeStock\Api\Response\Files` allows you to -
* `getNbResults` - Get the value of 'nb_results' column from the Files response
* `getFiles` - Get the list of `StockFile` returned by Files api

### Accessing License 
##### License
`License` class allows you to purchase an asset, information about purchasing the asset, information about a user's licensing (entitlement) status, determine whether the user has an existing license for an asset,for notifying the system when a user     abandons a licensing operation, request a license for an asset for that user if user have authorization for licensing assets and fetch the URL of the asset if it is already licensed.

* This is an overview of the process:
    * Call `getContentInfo` to determine whether the asset is already licensed. If not, call `getMemberProfile` to get your user's purchase options.
    * If the user opts to continue with the purchase, call `getContentLicense`.
    * If the user cancels out of the purchase, call `abandonLicense`.

* To license Adobe Stock images :
    * Call `SearchFiles` to find an asset that you want to license. 
    * Search returns the `asset's identifier` in the id field.
    * Get an `access token` for the user.  
    * Call various License APIs using params like content id ,license state, purchase state, locale to perform these        operations.
    * Call `downloadAssetUrl` to fetch the URL of the asset if it is already licensed or `downloadAssetRequest` to fetch the guzzle request object that contains url of the asset that can be downloaded by hitting request or `downloadAssetStream` to get the Image Buffer.
    
#### Instantiation
You can construct the object of this class with below arguments -
* Requires:
    * `config` - the stock configuration object of `StockConfig` type.

* Returns:
    * `LicenseResponse` - The response object containing the asset content id, purchase details, license state results matching the request object returned by `getContentInfo` , `getContentLicense`, `getMemberProfile`,`abandonLicense` method.
    
#### License Request
 In order to call `License` APIs you need to create `LicenseRequest` object for licensing assets, for getting licensing information about a specific asset for specific user, for notifying the system when a user abandons a licensing operation, for getting the licensing capabilities for a specific user.
 
|Request Parameter| Setter Methods | Related Constants (If applicable)    |Description|
|---|---|---|---|
|content_id|setContentId| |Asset's unique identifer.You can get this from a Search response's id attribute|
|license|setLicenseState|licenseStateParams |Use only with Content/Info, Content/License, and Member/Profile. The Adobe Stock licensing state for the asset.|
|locale    |setLocale| |Use only with Member/Profile.Optional. Location language code for the API to use when returning localized messages. The API can usually get the user's default locale through the Authorization header. This value overrides that or provides a locale if not available through Authorization.|
|state |setPurchaseState|purchaseStateParams|Use only with Member/Abandon.The purchase_options.state from the Member/Profile results.|
|license_reference|setLicenseReference| |Array of license references of type `LicenseReference`. Use only with Content/License API.|
##### License State 
Adobe Stock licensing state for the asset.    
* Types of License States : 
    
    * For images, photos, or illustrations you can request:
        * `Standard` - Licenses the full-resolution image
        * `Standard_M` - Licenses a medium-sized image that is approximately 1600x1200 pixels
        * `Extended` - Extended license for the full-resolution image
    * For video you can request:
        * `Video_HD` - Licenses the HD-resolution video
        * `Video_4K` - Licenses the 4K-resolution video  
    * For vector assets: `Standard` or `Extended`
    * For 3D assets:  `Standard`  
    * For templates: `Standard`

##### Purchase States
User's purchase relationship to an asset.
* Various Purchase States :
    * `NOT_PURCHASED` -  User has not at any time in the past purchased the asset.
    * `PURCHASED` - User has at some time in the past purchased the asset.
    * `CANCELLED` - User attempted to buy the asset and for some reason the order did not go through.
    * `NOT_POSSIBLE` - User must go to the Adobe Stock site to buy plan or asset.
    * `JUST_PURCHASED` - User bought asset within the current session.
    * `OVERAGE` - Adobe Stock has a payment instrument on file for the user and can bill the user for additional purchases.
    
#### License Response
After calling various APIs in `License` class, reponse is returned in the form of `LicenseResponse`. It contains following fields. All class objects used in response are defined below.

|Request Parameter| Getter Methods | Related Class     |Description|
|---|---|---|---|
|available_entitlement |getEntitlement|LicenseEntitlement|Information about licenses available for the user. See LicenseEntitlement|
|purchase_options|getPurchaseOptions|LicensePurchaseOptions|Information about the user's purchasing options for the asset. See LicensePurchaseOptions|
|member|getMemberinfo|LicenseMemberInfo|Information about the user. See LicenseMemberInfo|
|license_references|getLicenseReferences|LicenseReferenceResponse|List of license references of the user. See LicenseReferenceResponse|
|contents|getContents|LicenseContent|Mapping from Asset unique identifier to Asset Licensing information. See LicenseContent|

##### LicenseEntitlement
* LicenseEntitlement gives Information about licenses available for the user.
    * `Quota` : Quantity of remaining licenses available for the user.
     * `License Type Id`: Stock Internal ID to know which kind of product can be used for licensing.
    * `Has Credit Model`: true if the selected entitlement is for an organization and this organization is generation 2.
    * `Has Agency Model`: true if the selected entitlement is for an organization and this organization is generation 3.
    * `Is CCE`: true if the selected entitlement for purchasing is one of an organization.
    * `Full Entitlement Quota`: Full quota of the user available entitlements.

##### LicensePurchaseOptions
* Information about the user's purchasing options for the asset.
    * `Purchase State` : User's purchase relationship to an asset.
    * `Requires Checkout` : Whether a purchase in process requires going to the Adobe Stock site for completion.
    * `Message` : Message to display to your user in response to a licensing API query.
    * `PurchaseUrl` : The URL to see purchase options plan.
    
##### LicenseMemberInfo
* Information about the user
    * `StockId` : User's unique Stock member identifier.
    
##### LicenseReferenceResponse
* License references marked as "required" must be submitted when licensing the image using the corresponding "id" attributes.
    * `Id` : License reference id.
    * `Text` : License reference description.
    * `Required` : Whether license reference must be submitted when licensing the image.
    
##### LicenseContent
* Licensing information for an asset for the user contained in the query response.
    * `Content Id` : Asset's unique identifier.
    * `Purchase Details` : Information about the user's purchase/license of this asset.
    * `Size` : The size of the asset, indicating whether it is the free complementary size or the original full-sized asset.
    * `Comp` : Information about the complementary or watermarked asset.
    * `Thumbnail` : Information about the asset thumbnail.
    
#### Methods
* `License` API allows you to call these four methods related to licensing stock assets. It can throw StockException if response is null or there is some API error.
    * `getContentInfo` requests licensing information about a specific asset for a specific user. You need to pass ims user `accessToken` and  `LicenseRequest` object containing content identifier, license state and locale(optional) parameters. If the request object is not valid or API returns with error, the method will throw the StockApiException.
    
    * `getContentLicense` requests a license for an asset for a specific user. You need to pass ims user `accessToken` and `LicenseRequest` object containing content_id ,License Reference and license. If the request object is not valid or API returns with error, the method will throw the StockApiException.
    
    * `getMemberProfile` returns the user's available purchase quota, the member identifier, and information that you can use to present licensing options to the user when the user next requests an asset purchase. In this 3 cases can occur -
        *  User has enough quota to license the next asset.
        *  User doesn't have enough quota and is set up to handle overage.
        *  User doesn't have quota and there is no overage plan.
You need to pass ims user `accessToken` and `LicenseRequest` object containing content_id, license state and locale. If the request object is not valid or API returns with error, the method will throw the StockApiException.
     
    * `abandonLicense` notifies the system when a user cancels a licensing operation. It can be used if the user refuses the opportunity to purchase or license the requested asset. You need to pass ims user `accessToken` and `LicenseRequest` object containing content_id and license state. If the request object is not valid or API returns with error, the method will throw the StockApiException.    
     * `downloadAssetRequest` provides the guzzle request object that contains url of the asset that can be downloaded by hitting request with guzzle client send method if it is already licensed otherwise throws StockApiException showing a message whether user has enough quota and can buy the license or not. You need to pass ims user `accessToken` and `LicenseRequest` object containing content_id and license state. If request is not valid or asset is not licensed or licensing information is not present for the asset or API returns with an error, the method will throw the StockApiException.   
    * `downloadAssetUrl` provides the URL of the asset if it is already licensed otherwise throws StockApiException showing a message whether user has enough quota and can buy the license or not. You need to pass ims user `accessToken` and `LicenseRequest` object containing content_id and license state. If request is not valid or asset is not licensed or licensing information is not present for the asset or API returns with an error, the method will throw the StockApiException.
     * `downloadAssetStream` provides the Image Buffer of the asset if it is already licensed otherwise throws StockApiException showing a message whether user has enough quota and can buy the license or not. You need to pass ims user `accessToken` and `LicenseRequest` object containing content_id and license state. If request is not valid or asset is not licensed or licensing information is not present for the asset or API returns with an error, the method will throw the StockApiException.
     

#### Examples
Examples showing how all methods are called with `LicenseRequest` and return `LicenseResponse`.

#### getContentInfo Example
``` PHP

        $request = new LicenseRequest();
        $request->setLocale('En_US');
        $request->setContentId(84071201);

        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $license_response = $this->_adobe_stock_client->getContentInfo($request, '');
   ```
#### getContentLicense Example
  ``` PHP
  
        $request = new LicenseRequest();
        $request->setLocale('En_US');
        $request->setContentId(84071201);
        
        $array = [[
        'id' => 1,
        'value' => 'test',
        ]];
        $request->setLicenseReference($array);
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $license_response = $this->_adobe_stock_client->getContentLicense($request, '');
  ```
#### getMemberProfile Example
``` PHP

        $request = new LicenseRequest();
        $request->setLocale('En_US');
        $request->setContentId(84071201);
    
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $license_response = $this->_adobe_stock_client->getMemberProfile($request, '');
```

#### abandonLicense Example
``` PHP

        $request = new LicenseRequest();
        $request->setLocale('En_US');
        $request->setContentId(84071201);
    
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $license_response = $this->_adobe_stock_client->abandonLicense($request, '');
```
#### downloadAssetRequest Example
``` PHP
 
        $request = new LicenseRequest();
        $request->setLicenseState('STANDARD');
        $request->setContentId(84071201);
   
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $guzzle_request = $this->_adobe_stock_client->downloadAssetRequest($request, '');
 
```

#### downloadAssetUrl Example
``` PHP
 
        $request = new LicenseRequest();
        $request->setLicenseState('STANDARD');
        $request->setContentId(84071201);
   
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $url = $this->_adobe_stock_client->downloadAssetUrl($request, '');
 
```
#### downloadAssetStream Example
``` PHP
 
        $request = new LicenseRequest();
        $request->setLicenseState('STANDARD');
        $request->setContentId(84071201);
   
        $this->_adobe_stock_client = new AdobeStock('AdobeStockClient1', 'Adobe Stock Lib/1.0.0', 'PROD', $http_client);
        $image_stream = $this->_adobe_stock_client->downloadAssetStream($request, '');
 
```

### Accessing LicenseHistory
#### LicenseHistory
`AdobeStock` class will allow you to access the LicenseHistory Api. You can construct the `LicenseHistoryRequest` object to set offset, limit, set result columns etc. for the LicenseHistory api.

First, You have to call `initializeLicenseHistory` to initialize license history api which will gives you adobe stock object from where you can call `getNextLicenseHistory`, `getPreviousLicenseHistory` etc. to fetch the results.
The `AdobeStock` provides paginated interface which allows you to call its methods (for e.g. `getNextLicenseHistory`, `getPreviousLicenseHistory` etc.) multiple times to retrieve the subsequent results in order. It maintains the current state of LicenseHistory request and initially, the state is pointing invalid LicenseHistory files results. As soon as, the `getNextLicenseHistory` method is called, it makes LicenseHistory api call and returns the results with `LicenseHistoryResponse` object. The `getNextLicenseHistory` moves the state to next page and fetch the response for the same. Similarly, the `getPreviousLicenseHistory` and `getLicenseHistoryPage` methods can be used to move one page behind and skip to a particular LicenseHistory page index respectively.

##### Instantiation
You can construct the object of this class with below arguments -
* Requires:
    * `access_token` - the adobe ims user access token.
    * `request` - the request object of `LicenseHistoryRequest` consisting the locale, results column, search parameters etc.

* Returns:
    * The response object (`LicenseHistoryResponse`) containing the LicenseHistory files api results matching the request object.
    
##### Example
Sample code to initialize the LicenseHistory Api -

``` PHP
        $results_columns = Constants::getResultColumns();
        $params = new SearchParamLicenseHistory();
        $params->setOffset(0)->setLimit(5);
        
        $result_column_array = [
            $results_columns['THUMBNAIL_110_URL'],
            $results_columns['THUMBNAIL_110_WIDTH'],
            $results_columns['THUMBNAIL_110_HEIGHT'],
        ];
        
        $request = new LicenseHistoryRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('LucaTest1', 'Spark Page', 'PROD', $http_client);
        $response = $this->_adobe_stock_client->initializeLicenseHistory($request, '');

```
More examples can be found at the end of this document.

##### Methods
* `AdobeStock` Methods for license history can throw StockException if there are no results available. It allows you to -
    * `getNextLicenseHistory` - Method to get next LicenseHistory files response page. It moves the state to next page and fetch the LicenseHistory response for the same. If the api returns with error or if there are no more search results available for the request, the method will throw the StockException.
    
    * `getPreviousLicenseHistory` -  Method to get previous LicenseHistory files response page. It moves the state to previous page and fetch the LicenseHistory response for the same. If the api returns with error or if there are no more search results available for the request or the state is pointing to invalid state, the method will throw the StockException.
    
    * `getLicenseHistoryPage` - Method to skip to a specific LicenseHistory files response page. It moves the state to provided LicenseHistory page and fetch the LicenseHistory response for the same. It will throw StockException if there is any failure while LicenseHistory api or if the provided licenseHistory page index is out of total pages available.
    
    * `getLastLicenseHistory` -  Get the response object of recently performed LicenseHistory api call either by using `getNextLicenseHistory` or `getPreviousLicenseHistory` or `getLicenseHistoryPage`. Initially, this method will return null since it is pointing to invalid state and no response available at this point.
    
    * `currentLicenseHistoryPageIndex` - Get the current search page index of LicenseHistory response available from recently performed `getNextLicenseHistory` or `getPreviousLicenseHistory` or `getLicenseHistoryPage` method. Initially, since the state is pointing to invalid state, it returns -1.
    
    * `getTotalLicenseHistoryPages` - Get the total number of LicenseHistory pages available from recently performed `getNextLicenseHistory` or `getPreviousLicenseHistory` or `getLicenseHistoryPage` method. Initially, since the state is pointing to invalid state, it returns -1.
    
    * `getTotalLicenseHistoryFiles` - Get the total number of LicenseHistory files available from recently performed `getNextLicenseHistory` or `getPreviousLicenseHistory` or `getLicenseHistoryPage` method. Initially, since the state is pointing to invalid state, it returns -1.
    
#### LicenseHistoryRequest
In order to make LicenseHistory API call, you need to create a LicenseHistoryRequest object to define the criterion for LicenseHistory files results. You can set the various search parameters, locale and required result columns supported by Stock LicenseHistory api here.

Here is the mapping of LicenseHistory api query parameters with the setters methods that you can use to set the corresponding parameters in PHP Stock SDK -

|API URL Query Parameter| Setter Methods in SearchFilesRequest |Description|
|---|---|---|
|locale|setLocale|Sets location language code. For e.g. "en-US", "fr-FR" etc.|
|search_parameters[*]|setSearchParams|Sets An object of `SearchParamLicenseHistory` where one can set all supported search_parameters|
|result_columns[]| setResultColumns | Allows to set the list of result columns required in the search results. If you are not setting result columns, it will set all default columns in result_column array at api level. For more details, read Result Columns section below.|    

#### SearchParameters
`SearchParamLicenseHistory` allows to set the various search_parameters (URL query parameters) supported by LicenseHistory api. This is the class where you can actually set the limit, offset, thumbnail_size etc.

Mapping of query parameter search_parameters[*] with SearchParamLicenseHistory class setter methods -

|Search Parameter| Setter Methods | Description|
|---|---|---|
|search_parameters[limit]|setLimit|Allows to set maximum number of assets to return in the call.|
|search_parameters[offset]|setOffset|Allows to set the start position in results. |
|search_parameters[thumbnail_size]|setThumbnailSize|Allows to set thumbnail size.Valid values - 110, 160,220,240,500, 1000 |

#### Result Columns
You can create array of ResultColumn enums to define columns that you want to include in your results.

##### Example
```PHP
    $results_columns = Constants::getResultColumns();
    $result_column_array = [
            $results_columns['THUMBNAIL_110_URL'],
            $results_columns['THUMBNAIL_110_WIDTH'],
            $results_columns['THUMBNAIL_110_HEIGHT'],
        ];
```
##### Note
If you are not setting result columns, it will set following columns in result_column array by default.
* Default Result Columns -
    * `NB_RESULTS`
    * `LICENSE`
    * `LICENSE_DATE`
    * `DOWNLOAD_URL`
    * `ID`
    * `TITLE`
    * `CREATOR_NAME`
    * `CREATOR_ID`
    * `WIDTH`
    * `HEIGHT`
    * `CONTENT_URL`
    * `MEDIA_TYPE_ID`
    * `VECTOR_TYPE`
    * `CONTENT_TYPE`
    * `DETAILS_URL`
    
#### LicenseHistoryResponse
It represents the LicenseHistory results returned with Stock LicenseHistory API. The `LicenseHistory` class methods for e.g. `getNextLicenseHistory` returns the object of `LicenseHistoryResponse` initialized with the results returned from the LicenseHistory api.
LicenseHistoryResponse allows you to -
* `getNbResults` - Get the value of 'nb_results' column from the LicenseHistory response
* `getFiles` - Get the list of `StockFile` returned by LicenseHistory api

#### Making a LicenseHistoryRequest and Calling LicenseHistory api
These are the complete examples showing how a request is created and then LicenseHistory api is called, which in turn returns results in the form of LicenseHistoryRequest.
* Example to get results by calling getNextLicenseHistory method:

```PHP
        $results_columns = Constants::getResultColumns();
        $params = new SearchParamLicenseHistory();
        $params->setOffset(0)->setLimit(5);
        
        $result_column_array = [
            $results_columns['THUMBNAIL_110_URL'],
            $results_columns['THUMBNAIL_110_WIDTH'],
            $results_columns['THUMBNAIL_110_HEIGHT'],
        ];
        
        $request = new LicenseHistoryRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('LucaTest1', 'Spark Page', 'PROD', $http_client);
        $response = $this->_adobe_stock_client->initializeLicenseHistory($request, '')->getNextLicenseHistory();

```
* Example to get previous results by calling getPreviousLicenseHistory method:

```PHP
        $results_columns = Constants::getResultColumns();
        $params = new SearchParamLicenseHistory();
        $params->setOffset(0)->setLimit(5);
        
        $result_column_array = [
            $results_columns['THUMBNAIL_110_URL'],
            $results_columns['THUMBNAIL_110_WIDTH'],
            $results_columns['THUMBNAIL_110_HEIGHT'],
        ];
        
        $request = new LicenseHistoryRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('LucaTest1', 'Spark Page', 'PROD', $http_client);
        $response = $this->_adobe_stock_client->initializeLicenseHistory($request, '')->getPreviousLicenseHistory();
        
```
* Example to skip to specific page of results by calling getLicenseHistoryPage method:

```PHP
        $results_columns = Constants::getResultColumns();
        $params = new SearchParamLicenseHistory();
        $params->setOffset(0)->setLimit(5);
        
        $result_column_array = [
            $results_columns['THUMBNAIL_110_URL'],
            $results_columns['THUMBNAIL_110_WIDTH'],
            $results_columns['THUMBNAIL_110_HEIGHT'],
        ];
        
        $request = new LicenseHistoryRequest();
        $request->setLocale('En_US');
        $request->setSearchParams($params);
        $request->setResultColumns($result_column_array);
        
        $this->_adobe_stock_client = new AdobeStock('LucaTest1', 'Spark Page', 'PROD', $http_client);
        $response = $this->_adobe_stock_client->initializeLicenseHistory($request, '')->getLicenseHistoryPage();
```

## Testing and Linting

### Tests
Run `composer run check` for linting and testcases.
Run `composer run test-coverage` for test coverage.

The above command will by default run the linting, test cases and the code coverage along with building the project. The linting results will be shown within the console output itself and if there are any issues the build will stop and fail instantly. If there are no linting issues found, the build will continue to build the project. It will also generate the detailed coverage reports for you.
* The coverage report can be found at `<project directory>/data/clover/index.html`
Note - Since the test and coverage steps come later in the build process than linting, so if linting fails, you won't get the coverage reports.

### Lint with PHP_CodeSniffer
This project uses [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) for linting. In addition, Adobe Stock has a custom set of rules for PHPCS that are included in this repository in the `libs` directory. This module will be installed when running `composer install`. It includes a bundled version of PHPCS which may be different from the one you have installed globally; the Composer script will run the correct version.

Linting checks are enforced with the build step itself. By default, the linting will run first and if there are any issues the build will fail.

### Running Test Suites
However, the `composer run check` will run the tests automatically but if you need to run the tests separately, please run the below command in console -
```
composer run test
```

### Coverage
Just run the `composer run test-coverage` as mentioned above, it should generate the coverage reports along with the test results and building the project. As mentioned above coverage reports can be found at
`<project directory>/data/clover/index.html`

## Contributing

If you would like to contribute to this project, [check out our contribution guidelines](CONTRIBUTING.md).
