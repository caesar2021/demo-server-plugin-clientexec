# Server Plugin Setup

### Custom Fields

|                       | Value              |
|-----------------------|--------------------|
| Name                  | Website Name       |
| Description           | Enter website name |
| Type                  | Text Field         |
| Is Required           | ✅                 |
| Include in Identifier | ✅                 |
| Include in Signup     | ✅                 |


|                       | Value              |
|-----------------------|--------------------|
| Name                  | Website URL        |
| Description           | Enter website URL  |
| Type                  | Text Field         |
| Is Required           | ✅                 |
| Is Changeable         | ✅                 |
| Include in Signup     | ✅                 |


### Server

|                           | Value             |
|---------------------------|-------------------|
| Name                      | Sample Server     |
| Hostname                  | sample.localhost  |
| Plugin                    | Sample            |
| *Plugin Options*:                             |
| Website Name Custom Field | Website Name      |
| Website URL Custom Field  | Website URL       |


### Product Group

|                   | Value                     |
|-------------------|---------------------------|
| Name              | Sample Group              |
| Type              | Hosting                   |
| Include in Signup | Yes                       |
| Custom Fields     | Website Name, Website URL |


### Addon

|                             | Value         |
|-----------------------------|---------------|
| Name                        | Disk Addon    |
| Available to Product Group  | Sample Group  |
| Plugin Variable             | Disk Space    |


### Product 

|                            | Value                                                         |
|----------------------------|---------------------------------------------------------------|
| Name                       |  Basic 1GB                                                    |
| Allow direct link          | ✅                                                            |
| Show in signup form        | ✅                                                            |
| Hide hosting custom fields | ✅                                                            |
| *Addons*                                                                                   |
| Disk Addon                 | Plugin Variable: `DISKSPACE`<br/> Display Type: Radio Buttons |
| *Advanced Plugin Settings*                                                                 |
| Associated Servers         | Sample Server                                                 |
| Disk Limit                 | 1024                                                          |