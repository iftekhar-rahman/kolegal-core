function calculateInterest() {
    var principal = parseFloat(document.getElementById("principal").value);
    var rate = parseFloat(document.getElementById("rate").value);
  
    // Get the date input values
    var startDay = parseInt(document.getElementById("startDay").value);
    var startMonth = parseInt(document.getElementById("startMonth").value);
    var startYear = parseInt(document.getElementById("startYear").value);
    var endDay = parseInt(document.getElementById("endDay").value);
    var endMonth = parseInt(document.getElementById("endMonth").value);
    var endYear = parseInt(document.getElementById("endYear").value);
  
    // Validate the date inputs
    if (
      !validateDate(startDay, startMonth, startYear) ||
      !validateDate(endDay, endMonth, endYear)
    ) {
      document.getElementById("result").innerHTML =
        "<strong>Error:</strong> Invalid date input.";
      return; // Stop the function if validation fails
    }
  
    // Construct Date objects
    var startDate = new Date(startYear, startMonth - 1, startDay);
    var endDate = new Date(endYear, endMonth - 1, endDay);
  
    // Check if start date is less than end date
    if (startDate >= endDate) {
      document.getElementById("result").innerHTML =
        "<strong>Error:</strong> Start date must be earlier than end date.";
      return; // Stop the function if the start date is not earlier
    }
  
    var period = document.getElementById("period").value;
  
    // Calculate the number of days between the dates
    var timeDiff = endDate - startDate;
    // var days = timeDiff / (1000 * 60 * 60 * 24);
    var days = Math.round(timeDiff / (1000 * 60 * 60 * 24));
  
    // Determine the divisor based on the period selected
    var divisor;
    switch (period) {
      case "daily":
        divisor = 1;
        break;
      case "weekly":
        divisor = 7;
        break;
      case "monthly":
        divisor = 30;
        break;
      case "quarterly":
        divisor = 91.25;
        break;
      case "half-yearly":
        divisor = 182.5;
        break;
      case "yearly":
        divisor = 365;
        break;
      default:
        divisor = 1; // Default to daily if period is not recognized
    }
  
    var interest = (principal * rate * (days / divisor)) / 100;
    var totalAmount = principal + interest;
  
    // Calculate years, months, and remaining days
    var years = Math.floor(days / 365);
    var remainingDays = days % 365;
    var months = Math.floor(remainingDays / 30);
    remainingDays %= 30;
  
    const resultDisplay = document.getElementById("result");
    resultDisplay.className = "result-display";
  
    // Format the time period
    var timePeriod = "";
    if (years > 0) {
      timePeriod += years + " year" + (years !== 1 ? "s " : " ");
    }
    if (months > 0) {
      timePeriod += months + " month" + (months !== 1 ? "s " : " ");
    }
    if (remainingDays > 0) {
      timePeriod += remainingDays + " day" + (remainingDays !== 1 ? "s" : "");
    }
  
    // Add content to the result display with titles in bold

      // Retrieve the elements to display results
      var interestResult = document.getElementById("interestResult");
      var totalAmountResult = document.getElementById("totalAmountResult");
      var timePeriodResult = document.getElementById("timePeriodResult");
  
      // Update the innerHTML of the result spans
      interestResult.innerHTML = "£" + interest.toFixed(2);
      totalAmountResult.innerHTML = "£" + totalAmount.toFixed(2);
      timePeriodResult.innerHTML = timePeriod;
  }
  
  function validateDate(day, month, year) {
    // Check if year, month, and day are numbers and within valid ranges
    if (isNaN(year) || year < 1) {
      return false;
    }
    if (isNaN(month) || month < 1 || month > 12) {
      return false;
    }
    if (isNaN(day) || day < 1 || day > 31) {
      return false;
    }
  
    // Check for specific months with fewer days
    if ((month === 4 || month === 6 || month === 9 || month === 11) && day > 30) {
      return false;
    }
  
    // Check for February and leap years
    if (month === 2) {
      if (isLeapYear(year) && day > 29) {
        return false;
      } else if (!isLeapYear(year) && day > 28) {
        return false;
      }
    }
  
    return true;
  }
  
  function isLeapYear(year) {
    // Leap year check
    return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
  }
  
  function reset() {
    document.getElementById("principal").value = "";
    document.getElementById("rate").value = "";
    document.getElementById("startDay").value = "";
    document.getElementById("startMonth").value = "";
    document.getElementById("startYear").value = "";
    document.getElementById("endDay").value = "";
    document.getElementById("endMonth").value = "";
    document.getElementById("endYear").value = "";
    document.getElementById("period").value = "daily"; // Set default period
    document.getElementById("interestResult").innerHTML = "-";
    document.getElementById("totalAmountResult").innerHTML = "-";
    document.getElementById("timePeriodResult").innerHTML = "-";
  }
  