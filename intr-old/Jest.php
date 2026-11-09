<?php
 
$array = [ 
     
    "Introduction of React Testing" => "Type ===> unit testing, integrated and E2E testing || Jest framework || react testing library",

    "Run First Test Case" => "extension ===> App.test.js || npm run test",

    "Write Basic Test Case" => "test('name',()=>{ expect(component).toBe(output) },time)",

    "Understand React Test Structure" => "Find text in screen || code in test file",

    "Write First React test case" => "same as above",

    "Test Input box" => "screen.getByRole || screen.getByPlaceholderText",

    "Test Case Run Options" => "By default view when npm run test || read by chat gpt",

    "Test group with describe function" => "describe.skip || describe.only || nested describe",

    "Test on change event | event fire" => "fireEvent.change || code in test.js",

    "Click event test case with button" => "code",

    "File and Folder naming convention" => "Create folder __tests__ || file-name.test.js || file-name.spec.js",

    "beforeEach | beforeAll | afterAll | afterEach hooks" => "",

    "Snapshot Testing | update Snapshots" => "capture a snapshot of a component and compare it against a previously stored snapshot.",

    "Important points | What we should test?" => "",

    "Functional Component method testing" => "code...",

    "RTL Query" => "Helpfull to detect element in screen",

    "getByRole Query" => "",

    "Multiple elements and Custom Role" => "custom role created by ===> <div role='any-text'>",

    "getAllByRole" => "Return in the form of array",

    "getByLabelText" => "",

    "getAllByLabelText" => "",

    "getByPlaceholderText and getAllByPlaceholderText" => "",

    "getByText and getAllByText" => "",

    "getByTestId and getAllByTestId" => "<div data-testid='any-text' ></div>",

    "Overriding data-testid" => "use configure from test library",

    "getByDisplayValue and getAllByDisplayValue" => "",

    "getByTitle and getAllByTitle" => "",

    "getByAltText and getAllByAltText" => "",

    "Priority Order for RTL Queries" => "",

    "Assertion Methods" => " Assert ===> expect(buttonElement[0]). Assert Method ===> toBeInTheDocument() || expect(buttonElement[0]).not.toBeInTheDocument() ",

    "TextMatch with String and Regex" => "screen.getByText('Clicked!',{exact:true}) || screen.getByText(/Clicked/i)",

    "TextMatch with Function" => "screen.getByText((content,element)=>{})",

    "QueryBy and QueryAllBy | Test hidden elements" => "",

    "findBy and findAllBy | test async elements" => "",

    "Test Elements with JavaScript Query | Custom Query" => "document.querySelector('#some-id')",

    "Querying Within Elements" => "within().getByText('asdasd') || test child element",

    "Click Event with User Event Library" => "alway use async and await || override the eventfire",
    
    "onChange Event Testing | Keyboard Interactions by User Event Library" => "code..",

    "Act function" => "use when deal with async function || when update state and it take time",

    "Test component Props" => "code...",

    "Functional Props Testing and Function Mocking" => "code...",

    "Debugging in React testing library" => "Automatic debbuging ===> display error in console || prettyDOM ===> display html in console eg : prettyDOM(container) || debug ===> display html in console eg : debug() || DEBUG_PRINT_LIMIT=1000 npm test ===> for display more line of code || logRoles ===> for display line after every element logRoles(container) ",

    "Testing playground chrome extension" => "",

    "Mock Service worker" => "Mock service worker || provide dummy api data for testing"


];

 

include('bottom.php');