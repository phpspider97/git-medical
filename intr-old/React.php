<?php
$array = [ 
    "Package" => "Package.json",

    "Reconsilation" => "Use diffing algo to detect what change in real and virtual DOM",

    "Features of react" => "JSX, Components, Virtual DOM, One-way data-binding",

    "Component" => "functional and class || stateless which return only html not deal with state } || stateful deal with state",

    "render" => "This function returns the HTML",

    "Virtual dom" => "Virtual representation of real dom",

    "JSX"=>"JSX stands for JavaScript XML || JSX allows you to write HTML elements || babel (JavaScript compiler), Javascript syntex extension",

    "State" => "useState, setState",

    "Props" => "{props-property-name} || read only",

    "Dumb component" => "Stateless functional component",

    "Life cycle" => "In class component 3-phase (Mount, Update, Unmount) (constructor, render, componentDidMount, componentDidUpdate, shouldcomponentUpdate, componentWillUnmount) ",

    "Hooks" => "Hooks are functions that allow functional components in React to use state, lifecycle methods, and other React features || Alway use keyword eg : useEffect, useState, useLayoutEffect || state logic re-usable",

    "Map" => "ARRAY.map(value,key)=>{}",

    "Fragment" => "<></> helpful for not create node but its a parent wrapper",

    "Lifting state up" => "Send Data from child to parent for this use calback function as prop parameter",

    "Pure component" => "In which component not unwanted re-rendering || Use memo hook",

    "Use ref" => "It is a hook || helpfull for manupulate dom element",

    "Forward ref" => "It is a hook || helpfull for manupulate child dom element",

    "Controlled component" => "All input field controll by state",

    "Uncontrolled component" => "Input field controll by state or controll by ref",

    "HOC" => "It is a function which take a component and return component with additinal modification",

    "Context api" => "It use provider and consumer || with the help send data to sibiling and application component",

    "Prop drilling" => "Send data from parent to multiple nested child",

    "error boundary" => "Created by class component wrapper with lifecycle ( componentDidCatch )",

    "Custom hook" => "way to share and reuse stateful logic across multiple components",

    "Redux" => "It use for application state management",

    "Components of redux" => "View->Action->Reducer->Store",

    "Flux" => "Flux is the application architecture",

    "React Router" => "Routing library",

    "Server side & client side rendering" => "Server side all html markup display in server",

    "React fiber" => "Break the diffing process in parts",

    "Synthatic event" => "Helpfull to make same functionality of event in every browser",

    "Middleware in redux" => "-",

    "useCallback" => "Helpful to improve application performance || use memo not work when send function as props so in that case we use the callBack",

    "useSelector" => "Helpfull for get redux state value || const data = useSelector(state => state.any-property)",

    "UseReducer" => "Like a react state hook but some advance feature",

    "Redux saga" => "It is a middleware || Thunk overcome by saga",

    "PropTypes" => "Validating the types of props passed to a component || it not effect on execution",

    "Lazy Loading" => "Its example of Code splitting || Is a technique used in React to load components only when they are actually needed",

    "Props children" => "this.props.children || it helpful for get parent div data if it is a wrapper.",

    "Refrensial equality" => "If assign variable then it copy the refrence value not only value",

    "Memoization" => "it is same as useMemo || in this save the result in cache and next time get from cache console.time() console.timeEnd()",

    "WebSockets" => "Real time data transfer || Socket is javascript library || npm i socket.io-client || WebSocket is a communication protocol that provides full-duplex communication channels over a single, long-lived connection. ",

    "Internationalization" => "npm i react-i18next i18next || Helpfull for multi language",

    //"React Query" => "Data fetching library || advance feauture like cache || npm i @tanstack/react-query",

    //"DisplayName property" => "MyComponent.displayName = 'MyComponent'",

    "UseEffect run when component destroy || useLayoutEffect" => "useEffect(()=>{ return ()=>{ } })",

    "Intereceptor" => "This allows you to modify or handle them globally.",

    "What are the limitations of the setState method, and how can they be overcome" => "Not update immidieatily || ",

    "How can you optimize a React application for performance" => "Use PureComponent or React.memo || Use React.lazy and Suspense || Caching || Reduce Network Requests",

    "What are React portals" => "React Portals provide a way to render children components outside the DOM hierarchy of their parent components in a React application.",

    "Event Pooling" => "Event pooling is a concept used in some JavaScript libraries or frameworks to optimize the handling of events by reusing event objects. || event as synch work || use e.persist() for handle asynch ",

    "Jest in React testing" => "Test Runner, Assertion Library, Mocking, Snapshot Testing, Code Coverage",

    //"render prop pattern" => "Promotes a more dynamic and configurable approach to building components in React",

    "Webpack in a React application" => "It is often used in React applications to bundle JavaScript, CSS, and other assets",

    // "Redux-saga Introduction" => "No need...",

    // "Architecture | Redux and saga flow diagram" => "No need...",

    // "Project setup" => "npm i redux react-redux redux-saga",

    // "Make Store in react-redux | Provider | wrapper" => "Redux ===> action.js, reducer.js, rootReducer.js, store.js",

    // "Action in redux" => "dispatch(function-name(data)) ==> send to action",

    // "Reducer" => "Multiple reducer",

    // "Switch Statement in Reducer" => "No need...",

    // "Get data from redux to Component" => "useSelector",

    // "Remove to Cart" => "",

    // "Redux toolkit, new action reducer file" => "npm i @reduxjs/toolkit || createstore depricate so use configureStore by toolkit",

    // "Configure Saga" => "npm i redux-saga",

    // "How to make API with JSON server" => "No need...",

    // "Call API with redux Saga" => "takeEvery || ",

    
 
];



//WORK ON THAT : [ Error boundary || * ], [ Lazy Loading || * ], [ Redux saga || * ], [ useCallback || * ], [ React portals ], [ useReducer || * ]


include('bottom.php');

?>

<style>
.resource-box {
    background:#f8f9fa;
    padding:20px;
    border-radius:15px;
    margin:20px 0;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}
.resource-item {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 20px;
    margin-bottom:12px;
    background:white;
    border-radius:12px;
    border-left:5px solid #0d6efd;
    transition:.3s;
}
.resource-item:hover {
    transform:translateX(5px);
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}
.resource-title {
    font-size:18px;
    font-weight:700;
    color:#343a40;
}
.resource-btn {
    padding:10px 18px;
    border-radius:25px;
    text-decoration:none;
    color:white;
    font-weight:600;
    transition:.3s;
}
.chatgpt {
    background:linear-gradient(135deg,#10a37f,#087f63);
}
.youtube {
    background:linear-gradient(135deg,#ff0000,#cc0000);
}
.resource-btn:hover {
    color:white;
    transform:scale(1.05);
}
</style>
<div class="resource-box">
    <div class="resource-item">
        <span class="resource-title">🤖 ChatGPT</span>
        <a href="https://chatgpt.com/c/6a30fdbf-9640-83e8-a265-30e9c4432c7f" 
           target="_blank" 
           class="resource-btn chatgpt">
           Open ChatGPT →
        </a>
    </div>
    <div class="resource-item">
        <span class="resource-title">▶️ YouTube</span>
        <a href="https://www.youtube.com/watch?v=5QkVq4gd8Mk&list=PL8p2I9GklV47BCAjiCtuV_liN9IwAl8pM&index=45" 
           target="_blank" 
           class="resource-btn youtube">
           Watch Video →
        </a>
    </div>
</div>