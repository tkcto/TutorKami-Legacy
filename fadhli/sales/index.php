<!doctype html>
<html lang="en">
<head>
    <!--Required meta tags for Bootstrap-->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!--Bootstrap CSS for styling-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
    <!--Font Awesome webfont for appendGrid button icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"/>
</head>
<body class="container">
    <!--Table element for appendGrid-->
    <table id="tblAppendGrid"></table>



  <button id="load" type="button" class="btn btn-primary">Load Data</button>




    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!--appendGrid JS library-->
    <script src="https://cdn.jsdelivr.net/npm/jquery.appendgrid@2/dist/AppendGrid.js"></script>
    <!--Script for initialize appendGrid-->
    <script>
/*
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize appendGrid
            var myAppendGrid = new AppendGrid({
                element: "tblAppendGrid",
                uiFramework: "bootstrap4",
                iconFramework: "fontawesome5",
                columns: [...]
            });
        });
 */       
        
var myAppendGrid = new AppendGrid({
  element: "tblAppendGrid",
  uiFramework: "bootstrap4",
  iconFramework: "fontawesome5",
  columns: [
    {
      name: "company",
      display: "Company"
    },
    {
      name: "name",
      display: "Contact Person"
    },
    {
      name: "country",
      display: "Country",
      type: "select",
      ctrlOptions: [
        "",
        "Germany",
        "Hong Kong",
        "Japan",
        "Malaysia",
        "Taiwan",
        "United Kingdom",
        "United States"
      ]
    },
    {
      name: "isNPO",
      display: "NPO?",
      type: "checkbox",
      cellClass: "text-center"
    },
    {
      name: "orderPlaced",
      display: "Order Placed",
      type: "number",
      ctrlAttr: {
        min: 0,
        max: 10000
      }
    },
    {
      name: "memberSince",
      display: "Member Since",
      type: "date",
      ctrlAttr: {
        maxlength: 10
      }
    },
    {
      name: "uid",
      type: "hidden",
      value: "0"
    }
  ],
  // Optional CSS classes, to make table slimmer!
  sectionClasses: {
    table: "table-sm",
    control: "form-control-sm",
    buttonGroup: "btn-group-sm"
  }
});
$("#load").on("click", function () {
  myAppendGrid.load([
    {
      uid: "d4c74a61-a24e-429f-9db0-3cf3aaa22425",
      name: "Monique Zebedee",
      company: "Welch LLC",
      country: "Japan",
      memberSince: "2012-02-18",
      orderPlaced: 111,
      level: "Bronze",
      isNPO: true
    },
    {
      uid: "afdf285d-da5c-4fa8-9225-201c858a173d",
      name: "Daryle McLaren",
      company: "Bogisich Group",
      country: "United States",
      memberSince: "2016-10-08",
      orderPlaced: 261,
      level: "Diamond",
      isNPO: false
    },
    {
      uid: "202a8afb-130b-476b-b415-c659f21a73e7",
      name: "Glori Spellecy",
      company: "Grady and Sons",
      country: "Germany",
      memberSince: "2014-07-28",
      orderPlaced: 282,
      level: "Gold",
      isNPO: false
    },
    {
      uid: "08c9adee-abdd-43d5-866d-ce540be19be8",
      name: "Blondy Boggis",
      company: "Eichmann, Parker and Herzog",
      country: "Malaysia",
      memberSince: "2010-08-17",
      orderPlaced: 308,
      level: "Platinum",
      isNPO: true
    },
    {
      uid: "57644023-cd0c-47ec-a556-fd8d4e21a4e7",
      name: "Batholomew Zecchii",
      company: "Corwin-Fahey",
      country: "Malaysia",
      memberSince: "2016-09-20",
      orderPlaced: 881,
      level: "Gold",
      isNPO: true
    },
    {
      uid: "38e08e8a-c7eb-41eb-9191-6bb2df1fd39b",
      name: "Paulie Poel",
      company: "MacGyver, Rohan and West",
      country: "United Kingdom",
      memberSince: "2016-12-26",
      orderPlaced: 387,
      level: "Silver",
      isNPO: false
    },
    {
      uid: "d7bf56d4-f955-4dca-b3db-b30eab590028",
      name: "Jessica Levett",
      company: "Lind, O'Kon and Hamill",
      country: "United States",
      memberSince: "2015-04-26",
      orderPlaced: 984,
      level: "Gold",
      isNPO: false
    },
    {
      uid: "b9075764-5228-4ca7-9435-7c362ce097e5",
      name: "Fonsie Spring",
      company: "McKenzie, Block and Wiegand",
      country: "Japan",
      memberSince: "2013-11-08",
      orderPlaced: 875,
      level: "Silver",
      isNPO: false
    }
  ]);
});
        
        
        
        
        
        
        
    </script>
</body>
</html>