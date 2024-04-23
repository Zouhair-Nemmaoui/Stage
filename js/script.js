const table = document.querySelector('#myTable');
let dataTable = null;
let originalDataOrder = []; // Array to store the original order of data

// Function to destroy DataTables.js and remove associated features
function destroyDataTable() {
    if (dataTable) {
        dataTable.destroy();
        dataTable = null;
    }
}

// Function to hide the table temporarily
function hideTable() {
    table.style.display = 'none';
}

// Event listener for DOMContentLoaded event
// Event listener for DOMContentLoaded event
// Event listener for DOMContentLoaded event
// Event listener for DOMContentLoaded event
window.addEventListener('DOMContentLoaded', function() {
    destroyDataTable(); // Destroy DataTable on page load
    hideTable(); // Hide the table

    // Recreate DataTables.js on page load
    table.style.display = 'table'; // Show the table
    dataTable = new DataTable('#myTable', {
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Add',
                action: function () {
                    // Redirect to the add page
                    window.location.href = "formulair.php"; // Change "add_page.php" to the actual URL of your add page
                }
            },
            'excel'
        ],
        order: [], // Disable initial ordering
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var title = column.header().textContent.trim();

                // Filter only for 'category' and 'technicien' columns
                if (title === 'category' || title === 'technicien') {
                    var select = $('<select class="custom-select"><option value="" disabled selected>' + title + '</option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    });
                } else {
                    // Create input element for other columns
                    var input = $('<input type="text" placeholder="' + title + '" />')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                }
            });
        }
    });
});


// Function to add data to the DataTable while preserving the original order
function addDataToTable(data) {
    if (dataTable) {
        // Add data to DataTable
        dataTable.rows.add(data).draw();
        // Sort the table by the category column (column index 4, starting from 0)
        dataTable.order([3, 'asc']).draw(); // Change the column index to 4 for the "النوع" column
    } else {
        // If DataTable is not initialized yet, store the data in the original order
        originalDataOrder = data;
    }
}

// Example usage:
const newData = [
    // New data to be added to the DataTable
];

// Add the new data to the DataTable
addDataToTable(newData);

$(document).ready(function() {
    // Initialize DataTable
    $('#myTable').DataTable();

    // Submit search form and filter DataTable
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var keyword = $('#searchKeyword').val();
        $('#myTable').DataTable().search(keyword).draw();
    });

    // Filter DataTable as you type in the search input
    $('#searchKeyword').on('input', function() {
        var keyword = $(this).val();
        $('#myTable').DataTable().search(keyword).draw();
    });
});