<?php
    header('Content-Type: application/json');
    include("../root.php");
    include(SITE_ROOT	.	"/classes/Portfolio.php");
    $portfolio_obj = NEW Portfolio();

    if(isset($_GET['portfolio_data'])){
        $permalink = $_GET['portfolio_data'];
        $a_api_portfolio_data = $portfolio_obj->getPerticularApiPortfolioData($permalink);
        $api_portfolio_comment_data = $portfolio_obj->getPerticularApiPortfolioBlogData($permalink);
        $api_portfolio_data['portfolio_data'] = $a_api_portfolio_data;
        $api_portfolio_data['blog_data'] = $api_portfolio_comment_data;
    }else{
        $api_portfolio_data = $portfolio_obj->getAllApiportfolioData();
    }
    echo json_encode($api_portfolio_data);
?>