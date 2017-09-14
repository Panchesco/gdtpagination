# Good at Pagination

Render ExpressionEngine pagination links for any set of results you can count.

## Installation

1. Place the gdtpagination folder in the /system/user/addons.
2. Install the plug-in in CP / Developer / Add-ons / Third Party Add-ons

## Usage

### `{exp:gdtpagination}`

Wrap EE's native [pagination tags](https://docs.expressionengine.com/latest/templates/pagination.html) in a `{exp:gdtpagination}` tag pair; provide the required parameters for:

- Total number of items you're paginating
- How many items you're displaying on each page.
- Which page you're on.


#### Parameters

- `total_items` -  Required. This is the total count of items to be paginated
- `per_page` - Required. This is how many items are shown on each page.
- `current_page` - Required. The current page indicator (offset) 
- `base_path` - Base path to use in the links to pages
- `prefix` - Prefix for the current page. Default is P.


#### Example Usage
Let's say we need to create a paginated list of files in a document library at the URL http://example.com/doc-library/files.

We're using the [Assets](https://eeharbor.com/assets/documentation) module to manage our files. Assets doesn't currently have built-in pagination, but it will give us the information we need to pass to our pagination plugin to create pagination links.

First, we'll display our list of files in our doc-library/files template:

##### Current page
```
{exp:assets:folder folder_id="2"}
    <h2>{folder_name}</h2>
    <ul>
        {exp:assets:files 
          folder_id="{folder_id}"
          limit="25"
          offset="{segment_3}"}
            <li><a href="{url}" target="_blank">{if title}{title}{if:else}{filename}{/if}</a> [{extension} {size}]</li>
        {/exp:assets:files}
    </ul>    
{/exp:assets:folder}
```
Next, because we're using the Assets module to manage our files, we can get get the value of our `total_items` parameter from the `{exp:assets:files}` tag and pass those to an embedded template. 
  Note: If we don't give {exp:assets:files} a limit, it will go with the default 100. We have thousands of files, so we'll need to set the limit high enough to account for that so we get a count of all of the files in the library.
    

##### Getting a count of total items
```
{exp:assets:files 
  folder_id="2"
  limit="10000"}
  {if count==1}
    {embed="doc-library/_pagination"
      total_items="{total_files}" 
      base_path="doc-library/files"  
      per_page="25"
      current_page="{segment_3}"
      prefix=""}
  {/if}
{/exp:assets:files}  
```
Finally, we've created an embedded file in the same template group. Notice we passed the parameters in embedded variables.
Now we can wrap ExpressionEngine's [pagination tags](https://docs.expressionengine.com/latest/templates/pagination.html) and they'll work for the items in our file library as they would if we were using them with channel channel entries.


##### Embedded Template
```
{exp:gdtpagination
      total_items="{embed:total_items}"
      per_page="{embed:per_page}"
      current_page="{embed:current_page}"
      base_path="{embed:base_path}"
      prefix="{embed:prefix}"} 
      {paginate}
        <p>Page {current_page} of {total_pages} pages {pagination_links}</p>
      {/paginate}
{/exp:gdtpagination}
```


## Change Log

### 1.0.0
- Initial release.

## License

Copyright (C) 2017 

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
THE AUTHOR BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


