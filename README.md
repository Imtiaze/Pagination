# Pagination
This is simple simple pagination system. By this project one can easily grab the idea of  pagination system. All the mechanism of pagination are explained in the comments


page  limit  offset
1       5      0  .
2       5      5  .
3       5      10 .
4       5      15 .

so, offset = (page * limit) - limit ;

number_of_page = ceil(44/5) = 8.5 = 9

~limit      -> How many rows(records) will be showed in one page.
~total page -> How many page will created based on number of rows.
~offset     -> In a page from which number data will be populated.
