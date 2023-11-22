<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual construction of information</title>

    <!-- Add these lines to include Toastr -->
    <!-- Include jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
    <link rel="stylesheet" href="css/toast.min.css ">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-d5SOe4r4U/CXg3Z5Q2TeGcy7XObOp7HvxLyoLlg+MI+vrCi5qSnG9Y8Ek6/tXMH6"
        crossorigin="anonymous">
    <style>
        .row-checkbox {
            width: 20px;
            height: 20px;
            background-color: blue;
            border: 1px solid #ddd;
            /* إضافة حدود للشيك بوكس */
        }

        .dropdown{
            width: 50%;
        }

        

        .row-checkbox2{
            width: 20px;
            height: 20px;
            background-color: blue;
            border: 1px solid #ddd;
        }

        #excel-data tr {
            border: none;
        }

        /* تحديد الإطار الخارجي للأعمدة الأولى */
        #excel-data td:nth-child(-n+4),
        #excel-data th:nth-child(-n+4) {
            border: none;
        }

        
        /* إضافة هيدر للأعمدة الأولى */
        #excel-data th:nth-child(-n+4) {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }

        .dropdown-container {
            position: relative;
        }

        .description {
            width: 100%;
            /* Set your desired width for the text part */
        }

        .dropdown {
            width: 100%;
            background: lightgrey;
        }

        .additional-dropdown {
          
            /* Set your desired width for the additional dropdown list */
        }

        .font-awesome-icon {
            margin-right: 5px;
            /* Adjust margin as needed */
            color: red;
            width: 30px;
            height: 30px;
        }

        .checkbox-cell {
            text-align: center;
        }

        .checkbox-cell input {
            margin: 0;
        }

        #loading-indicator {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    
    <div class="container mt-5">
        <div id="loading-indicator" class="alert alert-info" role="alert">
            Importing data... Please wait.
        </div>
        <h6>Manual construction of information</h6>
        <input type="file" id="input" class="form-control mb-3" />
        <button id="view-button" class="btn btn-primary">View Excel Sheet</button>
        <!-- Add this button after the existing "View Excel Sheet" button -->
        <button id="save-button" class="btn btn-success">Save Mapping</button>

        <table id="excel-data" class="table table-bordered mt-2"></table>

        <div id="pagination" class="pagination-container"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
    <script src="js/toast.js"></script>
    <script>
        document.getElementById('view-button').addEventListener('click', function () {
            var fileInput = document.getElementById('input');
            var file = fileInput.files[0];
            var reader = new FileReader();

            // Show the loading indicator
            document.getElementById('loading-indicator').style.display = 'block';

            reader.onload = function (e) {
                var data = e.target.result;
                var workbook = XLSX.read(data, {
                    type: 'array'
                });
                var sheetName = workbook.SheetNames[0];
                var sheet = workbook.Sheets[sheetName];
                var html = XLSX.utils.sheet_to_html(sheet);

                document.getElementById('excel-data').innerHTML = html;

                // Add a delay of 2 seconds before hiding the loading indicator
                setTimeout(function () {
                    document.getElementById('loading-indicator').style.display = 'none';
                    addCheckboxToRows();
                    addDropdowns(workbook);
                    addPagination();
                }, 3000);
            };

            reader.readAsArrayBuffer(file);

            function addCheckboxToRows() {
                var table = document.getElementById('excel-data');
                var rows = table.getElementsByTagName('tr');

                for (let i = 0; i < rows.length; i++) {
                    let row = rows[i];

                    // Insert a cell for the main checkbox at the fourth position in each row
                    let mainCheckboxCell = row.insertCell(3);
                    mainCheckboxCell.className = 'checkbox-cell';

                    let mainCheckbox = document.createElement('input');
                    mainCheckbox.type = 'checkbox';
                    mainCheckbox.className = 'row-checkbox';
                    mainCheckbox.checked = false;
                    mainCheckboxCell.appendChild(mainCheckbox);

                    // Insert a cell for the additional checkbox at the sixth position in each row
                    let additionalCheckboxCell = row.insertCell(5);
                    additionalCheckboxCell.className = 'checkbox-cell';

                    let additionalCheckbox = document.createElement('input');
                    additionalCheckbox.type = 'checkbox';
                    additionalCheckbox.className = 'row-checkbox2';
                    additionalCheckbox.checked = false;
                    additionalCheckboxCell.appendChild(additionalCheckbox);

                    // Add event listener to the main checkbox
                    mainCheckbox.addEventListener('change', function () {
                        // Handle main checkbox change if needed
                    });

                    // Add event listener to the additional checkbox
                    additionalCheckbox.addEventListener('change', function () {
                        // Handle additional checkbox change if needed
                    });
                }
               }
            });

        let selectedOptionText, descriptionText, idText;
  function addDropdowns(workbook) {
    var table = document.getElementById('excel-data');
    var rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let row = rows[i];
        let idTextElement = row.cells[1];
        let idText = idTextElement ? idTextElement.innerText.trim() : '';
        let similarityPercentColumn = row.insertCell(2);
        similarityPercentColumn.className = 'similarity-percent';

        // Insert checkbox cell at the fourth position in each row
        let checkboxCell = row.insertCell(3);
        checkboxCell.className = 'checkbox-cell';

        let checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.className = 'row-checkbox';
        checkbox.checked = false;
        checkboxCell.appendChild(checkbox);

        // Create container for description and dropdown
        let container = document.createElement('div');
        container.className = 'dropdown-container';

        // Create Font Awesome icon element
        let fontAwesomeIcon = document.createElement('i');
        fontAwesomeIcon.className = 'fab fa-microsoft fa-2x font-awesome-icon';

        // Create description element
        let description = document.createElement('div');
        description.className = 'description';
        description.appendChild(fontAwesomeIcon); // Append Font Awesome icon to the description element
        description.textContent = ''; // Clear the content of the description element

        // Create dropdown list for the main reason
        let select = document.createElement('select');
        select.className = 'dropdown form-select';

        // Call the function to retrieve dropdown options
        getDropdownData(function (options) {
            options.forEach(function (option) {
                let opt = document.createElement('option');
                opt.value = option.id;
                opt.text = option.description;
                select.appendChild(opt);
            });
        });

        // Append description and main dropdown to the container
        container.appendChild(description);
        container.appendChild(select);

        // Add a new column at the end of each row for the main dropdown
        let dropdownColumn = row.insertCell(-1);
        dropdownColumn.appendChild(container);

        // Add event listener to the main dropdown to capture the selected value
        select.addEventListener('change', function () {
            // Get the text of the selected option
            selectedOptionText = this.options[this.selectedIndex].text;
            // Get the text of the second column (description) in the same row
            let descriptionTextElement = row.cells[1].querySelector('.description');
            descriptionText = descriptionTextElement ? descriptionTextElement.innerText.trim() : '';

            sendToServer(idText, selectedOptionText, descriptionText, row);            
        });

        // Function to send data to the server
        function sendToServer(idText, selectedOptionText, descriptionText, row) {
                    // Make an AJAX request to the server
                    fetch('/api/getSimilarityPercentage', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                dropdown_value: selectedOptionText,
                                text_value: descriptionText,
                                id: idText,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            row.cells[2].textContent = `${data.message}`;
                        })
                        .catch(error => console.error(error));
                }
            
    
        // Create additional dropdown list for reasons
        let additionalContainer = document.createElement('div');
        additionalContainer.className = 'dropdown-container';

        let additionalSelect = document.createElement('select');
        additionalSelect.className = 'additional-dropdown form-select';

        // Add options to the additional dropdown (you need to customize this part)
        for (let k = 1; k <= 3; k++) {
            let opt = document.createElement('option');
            opt.value = `Reason ${k}`;
            opt.text = `Reason ${k}`;
            additionalSelect.appendChild(opt);
        }

        // Append additional dropdown to the container
        additionalContainer.appendChild(additionalSelect);

        // Add a new column at the end of each row for the additional dropdown
        let additionalDropdownColumn = row.insertCell(-1);
        additionalDropdownColumn.appendChild(additionalContainer);
    }
}

        function getDropdownData(callback) {
            fetch('/getDropdownData')
                .then(response => response.json())
                .then(data => {
                    callback(data); // Invoke the callback function with the retrieved data
                })
                .catch(error => console.error(error));
        }

        /*document.getElementById('save-button').addEventListener('click', function () {
            // Iterate through rows and get selected values
            var table = document.getElementById('excel-data');
            var rows = table.getElementsByTagName('tr');
    
            for (let i = 0; i < rows.length; i++) {
                let row = rows[i];

                // Get main_data_id and additional dropdown value
                let mainDataId = row.cells[1].querySelector('.dropdown').value;
                let additionalDropdownValue = row.cells[row.cells.length - 1].querySelector('.additional-dropdown').value;

                let checkbox = row.cells[3].querySelector('.row-checkbox');
                let checkbox2 = row.cells[5].querySelector('.row-checkbox2');

             
                if (checkbox && checkbox.checked  ||  checkbox2  && checkbox2.checked) {
                    // Get main_data_id and additional dropdown value
                    let mainDataId = row.cells[1].querySelector('.dropdown').value;
                    let additionalDropdownValue = row.cells[row.cells.length - 1].querySelector('.additional-dropdown').value;
                    let percentValue1 = row.cells[4].textContent; // Replace this with your logic to get the percent value
                    let percentValue = row.cells[2].textContent; // Replace this with your logic to get the percent value
                    
                    saveMappingData(mainDataId, additionalDropdownValue, percentValue, percentValue1, row);

                    // Call the function to update similarity and display the alert
                    updateSimilarityPercent(mainDataId, additionalDropdownValue, percentValue1, row);
                }
            }
        });*/


        document.getElementById('save-button').addEventListener('click', function () {
            // Iterate through rows and get selected values
            var table = document.getElementById('excel-data');
            var rows = table.getElementsByTagName('tr');

        
            for (let i = 0; i < rows.length; i++) {

                let row = rows[i];
               
                // Get main_data_id and additional dropdown value
                let mainDataId = row.cells[8].querySelector('.dropdown').value;
                let additionalDropdownValue = row.cells[row.cells.length - 1].querySelector('.additional-dropdown').value;
                let mainCheckbox = row.cells[3].querySelector('.row-checkbox');
                let additionalCheckbox = row.cells[5].querySelector('.row-checkbox');
                let additionalCheckbox2 = row.cells[7].querySelector('.row-checkbox2');
        
                // Check if either the main checkbox or additional checkbox is checked
                if ((mainCheckbox && mainCheckbox.checked) || (additionalCheckbox && additionalCheckbox.checked) || (additionalCheckbox2 && additionalCheckbox2.checked) ) {
                 
                    let description = row.cells[1].textContent;
                    let description2 = row.cells[4].textContent; 
                    let description3  = row.cells[6].textContent;
                    let percentValue = row.cells[2].textContent;
                    
                  
                    // Check which checkbox is checked and send the corresponding request
                    if (mainCheckbox && mainCheckbox.checked) {
                        // Call the function to update similarity and display the alert for the main checkbox
                        saveMappingData(mainDataId, additionalDropdownValue, percentValue, percentValue1, row, 'mainCheckbox');
                    }
        
                    if (additionalCheckbox && additionalCheckbox.checked) {
                        // Call the function to update similarity and display the alert for the additional checkbox
                        saveMappingData(mainDataId, additionalDropdownValue, percentValue, percentValue1, row, 'additionalCheckbox');
                    }     


                    
                    
                }
            }
        });
        
        function saveMappingData(mainDataId, description, percentValue, checkboxType) {
            fetch('api/saveMappingData', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    main_data_id: mainDataId,
                    description: description,
                    percent: percentValue, // Add the percent value
                    checkbox_type: checkboxType, // Add the type of checkbox (mainCheckbox or additionalCheckbox)
                }),
            })
                .then(response => response.json())
                .then(data => {
                    // Show Toastr notification
                    if (data.message) {
                        swal("DataBase has been updating... ", "success!", "success");
                        let percentageCell = row.cells[2];
                        if (percentageCell) {
                            percentageCell.textContent = `${data.message}`;
                        }
                    } else {
                        alert("Failed to save mapping.");
                        toastr.error('Failed to save mapping.', 'Error');
                    }
                })
                .catch(error => console.error(error));
        }
        



        function saveMappingData(mainDataId, additionalDropdownValue, percentValue, percentValue1, row) {
            fetch('api/saveMappingData', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        main_data_id: mainDataId,
                        description: additionalDropdownValue,
                        description2:percentValue1,
                        percent: percentValue, // Add the percent value
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Show Toastr notification
                    if (data.message) {
                        swal("DataBase has been updating... ", "success!", "success");
                        let percentageCell = row.cells[2];
                        if (percentageCell) {
                           
                            percentageCell.textContent = `${data.message}`;
                        }
                    } else {
                        alert("Failed to save mapping.");
                        toastr.error('Failed to save mapping.', 'Error');
                    }
                })
                .catch(error => console.error(error));
        }

        function updateSimilarityPercent(mainDataId, additionalDropdownValue, row) {
            // Call the Laravel endpoint to get the similarity percentage
            fetch(`/api/getSimilarityPercentage`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        dropdown_value: mainDataId,
                        text_value: additionalDropdownValue,
                        id: idText,
                        selected_option_text: selectedOptionText,
                        description_text: descriptionText,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Update the displayed similarity percentage
                    row.cells[2].textContent = `${data.message}`;
                })
                .catch(error => console.error(error));
        }
    </script>
</body>

</html>
