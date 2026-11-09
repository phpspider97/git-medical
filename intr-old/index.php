<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Index</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f7fb;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }
        .container{
            max-width:1500px;
        }
        .table tbody tr{
            transition:.2s;
        }

        .table tbody tr:hover{
            background:#f1f7ff;
        }

        a{
            text-decoration:none;
        }

        a:hover{
            text-decoration:underline;
        }

        .badge{
            font-size:14px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">📁 Project Directory</h3>

            <span class="badge bg-light text-dark" id="totalFiles">
                Loading...
            </span>
        </div>

        <div class="card-body">

            <input
                type="text"
                id="search"
                class="form-control mb-3"
                placeholder="Search file or folder..."
            >

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="70">#</th>
                        <th>Project / Folder</th>
                    </tr>
                </thead>

                <tbody id="tableBody">

                <?php

                $files = [];

                if ($handle = opendir(".")) {

                    while (($entry = readdir($handle)) !== false) {

                        if ($entry != "." && $entry != "..") {
                            $files[] = $entry;
                        }
                    }

                    closedir($handle);
                }

                sort($files, SORT_NATURAL | SORT_FLAG_CASE);

                $count = 1;

                foreach ($files as $entry) {

                    $icon = is_dir($entry)
                        ? "📁"
                        : "📄";

                    echo "
                    <tr>
                        <td>{$count}</td>

                        <td>
                            {$icon}
                            <a href='{$entry}' class='fw-semibold'>
                                {$entry}
                            </a>
                        </td>
                    </tr>";

                    $count++;
                }

                ?>

                </tbody>
            </table>

        </div>

    </div>

</div>

<script>
const search = document.getElementById("search");

search.addEventListener("keyup", function(){

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll("#tableBody tr");

    let visible = 0;

    rows.forEach(row=>{

        if(row.innerText.toLowerCase().includes(value)){
            row.style.display="";
            visible++;
        }else{
            row.style.display="none";
        }

    });

    document.getElementById("totalFiles").innerHTML = visible+" Items";
});

document.getElementById("totalFiles").innerHTML =
document.querySelectorAll("#tableBody tr").length + " Items";
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>