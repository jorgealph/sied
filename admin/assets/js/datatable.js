

var handleDataTableDefault = function() {
	"use strict";
    
    if ($('#data-table').length !== 0) {
        $('#data-table').DataTable(
            {
                stateSave: true,
                responsive:!0,  
                "bFilter": false, 
                "pageLength": 5, 
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]], 
                "bLengthChange": false
            }
        )
    }
};

var TableManageDefault = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleDataTableDefault();
        }
    };
}();