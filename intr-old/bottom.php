<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Programming Topics</title>


<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">


<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


<style>


body {

    background: #f5f7fb;
    font-family: 'Inter', sans-serif;
    color:#343a40;

}


/* Main Container */

.container {

    max-width:1500px;

}



/* Card */

.card {

    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);

}



/* Header */

.card-header {

    background:linear-gradient(
        135deg,
        #0a9396,
        #9b2226
    );

    color:white;
    padding:30px;

}


.card-header h1 {

    font-size:32px;
    font-weight:800;
    margin-bottom:10px;

}


.card-header p {

    opacity:.9;
    font-size:16px;

}



/* Search */

#search {

    border-radius:30px;
    padding:14px 22px;
    border:1px solid #ddd;
    font-size:15px;

}


#search:focus {

    box-shadow:0 0 0 .25rem rgba(13,110,253,.15);

}



/* Table */


.table {

    margin-bottom:0;

}


.table thead th {

    background:#450920;
    color:white;
    padding:16px;
    font-size:15px;
    border:none;

}



.table tbody td,
.table tbody th {

    padding:18px;
    vertical-align:middle;

}



.table tbody tr {

    transition:.25s;

}



.table tbody tr:hover {

    background:#eef5ff;
    transform:translateY(-2px);

}



/* Number */

.number {

    width:60px;
    font-weight:700;
    color:#6c757d;

}



/* Topic Badge */


.topic-badge {

    border: 2px solid #ca6702;
    background: rgba(202, 103, 2, 0.70);
    color:white;

    padding:8px 15px;

    border-radius:20px;

    font-size:14px;

    font-weight:700;

    display:inline-block;

}



/* Explanation */


.description {

    font-size:18px;

    line-height:1.8;

    color:#495057;

}



/* Code Font */


code,
pre {

    font-family:'JetBrains Mono', monospace;

}



.footer {

    text-align:center;

    color:#6c757d;

    font-size:14px;

    margin-top:20px;

}

/* ===========================
   TABLE
=========================== */

.table {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.table thead th {
    background: #450920;
    color: white;
    padding: 16px;
    font-size: 15px;
    border: none;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table tbody td,
.table tbody th {
    padding: 18px;
    vertical-align: middle;
    transition: all .25s ease;
}

/* Zebra striping */
.table-striped > tbody > tr:nth-of-type(odd) > * {
    background-color: #fafafa;
}

/* Hover effect */
.table tbody tr {
    cursor: pointer;
    transition: transform .25s ease;
}

.table tbody tr:hover {
    transform: translateY(-2px);
    font-size:19px;
}

/* Change ALL cells when hovering */
.table tbody tr:hover > td,
.table tbody tr:hover > th {

    background: linear-gradient(
        90deg,
        #fff7e6,
        #ffe8b3
    ) !important;

    color: #212529;
    font-size:19px;

}

/* Left border highlight */
.table tbody tr:hover > th:first-child {
    border-left: 5px solid #ca6702;
    font-size:19px;
}

/* Nice separator */
.table tbody tr td,
.table tbody tr th {
    border-bottom: 1px solid #ececec;
}


</style>


</head>


<body>


<div class="container">


<div class="card">


    <!-- Header -->

    <div class="card-header">


        <h1>
            📚 Programming Topics ( <u><b><?= strToUpper(basename($_SERVER['PHP_SELF'], ".php")); ?></b></u> )
        </h1>


        <p class="mb-0">
            Learn important programming concepts with detailed explanations
        </p>


    </div>

    <div class="footer mb-3">

        Total Topics:
        <?= count($array); ?>

    </div>

    <div class="card-body1">

    
        <!-- Search -->

        <!-- <input 
            type="text"
            id="search"
            class="form-control mb-4"
            placeholder="🔍 Search topic..."
        > -->




        <div class="table-responsive">


        <table class="table table-striped align-middle">


            <thead>

                <tr>

                    <th width="80">
                        #
                    </th>

                    <th width="25%">
                        Topic
                    </th>


                    <th>
                        Explanation
                    </th>

                </tr>


            </thead>




            <tbody id="topicTable">


            <?php

            $count = 1;


            foreach($array as $topic=>$value)
            {


            ?>


            <tr>


                <th class="number">

                    <?= $count++; ?>

                </th>



                <td>


                    <span class="topic-badge">

                        <?= htmlspecialchars(strToUpper($topic)); ?>

                    </span>


                </td>




                <td class="description">


                    <?= nl2br(htmlspecialchars($value)); ?>


                </td>



            </tr>


            <?php

            }

            ?>


            </tbody>



        </table>


        </div>



    </div>


</div>

</div>





<script>


const search = document.getElementById("search");


search.addEventListener("keyup",function(){


    let value = this.value.toLowerCase();


    document
    .querySelectorAll("#topicTable tr")
    .forEach(row=>{


        if(row.innerText.toLowerCase().includes(value))
        {

            row.style.display="";

        }
        else
        {

            row.style.display="none";

        }


    });


});



</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>