document.addEventListener("DOMContentLoaded", () => {
    // Print functionality
    const printButton = document.getElementById("print-btn"); // Get the button by ID
    if (printButton) {
      printButton.addEventListener("click", function () {
        console.log("Printing screen clicked!!!");
  
        // Get the content of the receipt
        const receiptContent = document.querySelector(".receipt").innerHTML;
  
        // Create a new window for printing
        const printWindow = window.open('', '_blank', 'width=600,height=400');
        printWindow.document.write('<html><head><title>Print Receipt</title>');
        printWindow.document.write('<link rel="stylesheet" type="text/css" href="styles/receipt.css" />'); // Include your styles if necessary
        printWindow.document.write('<link rel="stylesheet" type="text/css" href="styles/global.css" />'); // Include your styles if necessary
        printWindow.document.write('</head><body>');
        printWindow.document.write(receiptContent); // Write the receipt content
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // Close the document
  
        // Wait for the document to be fully loaded before printing
        printWindow.onload = function() {
          printWindow.focus(); // Focus on the new window
          printWindow.print(); // Trigger the print dialog
          printWindow.close(); // Close the print window after printing
        };
      });
    }
  });
  