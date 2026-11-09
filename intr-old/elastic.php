<?php
echo "<pre>";
echo 'Elastic Stack :
    Elastic search, kibana, logstash, beat, x-pack
    Elasticsearch install
    Elasticsearch Architecture ( Node, Cluster, _index, _source, _type)
    Elasticsearch REST API 
    REST API by Command Line
    Sharding ( split api, shrink api )
    Replication ( replication group, master and child, made in different node )
    Create Multiple Nodes ( elasticsearch.yml - (change node name), node 1 token --> start node 2 with token )
    Node Roles ( master node-(node.master:true), data role-(node.master:true), ingest-(node.ingest:true), ml role, coordination role-(false all), voating only-(node.voating:true) )
    CRUD Operations ( PUT index-name,  )
    Routing ( select the shards, if you start insert document then not increase shard  )
    How Elasticsearch Read Data ( Coordination node --> data node --> routing --> replication group )
    How Elasticsearch Writes Data ( Coordination node --> data node --> routing --> replication group-(primary replica thrn child) )
    seq_no and primary_term ( global and local check point )
    update_by_query and delete_by_query
    Bulk Api ( _bulk, index, create, update, delete (action, data) )
    _analyze API ( inverted index, character filter(remove html tag), tokenization(split into words), token filter(convert to lowercase), char_filter:[], tokenizer:"standard", filter:["lowercase"] )
    Inverted Index ( split the word and add how many time is appear in which document )
    doc_values ( string --> stored in inverted index, numeric---> stored in doc, keyword like email )
    ';