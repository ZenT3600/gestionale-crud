# DB Structure

### songs
| **ID** | **Title** | **AlbumID** | **ArtistID** | **CoverArt** | **Rating** |
| --- | --- | --- | --- | --- | --- |
| Integer | Text | Integer | Integer | Text (URL) | Integer |

### albums
| **ID** | **Title** | **ReleaseYear** | **Rating** |
| --- | --- | --- | --- |
| Integer | Text | Integer | Integer |

### artist
| **ID** | **Name** | **Description** |
| --- | --- | --- |
| Integer| Text | Text |
