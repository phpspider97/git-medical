<?php
$array = [ 
    "Introduction" => "React js framework",

    "Install and Setup Next.js" => "npx create-next-app@latest",

    "First Program" => "Component",

    "Events | Functions | state" => "use client || component inside component",

    "File and folder" => "...",

    "Component Type ===> server component || Client component" => "deafult all component is server component",

    "Basic Routing" => "create a folder and create a file page.js about/page.js",

    "Link and Navigation" => "Link ===> like anchor tag { import Link from 'next/link' } || Navigation ==> like click on button { import { useRouter } from 'next/navigation' }",

    "Nested Routing" => "about/about-nested/page.js",

    "Common Layout" => "layout.js",

    "Conditional Layout" => "import { usePathName } from 'next/navigation' || apply condition",
    
    "Dynamic Routing" => "[folder-name]/page.js || {params} in props",

    "Catch-all Segments of Route" => "[...folder-name]/page.js",

    "404 page not found" => "not-found.js (global)",

    "Middleware" => "In app folder ===> middleware.js",

    "Rendering" => "pre-rendring || static generation",

    "Client Side or PreRendering" => "Serverside rendring more fast and secure",

    "fetch API in Client component" => "as i know",

    "Call API in Server component" => "Make function add api code and use in component",

    "Use client component with server component" => "Create another component and make it client and import in server { thats the only solution }",

    "Style" => "Global || Inline",

    "CSS Modules" => ".module.css || import custom from filename and use as className='custom.main' || if use outside of app then import from '@/folder-name/file-name' ",

    "Conditional style" => "use state and ternary operator",

    "Image Optimization" => "image from next/image || <Image src={} />",

    "Font Optimization" => "...",

    "generateMetadata for Dynamic meta data" => "export function generateMetadata({params}){ return {title:'This is title'} }",

    "Script component" => "Use script in specific file || import script from 'next/script' || '&#60;Script src='' /&#62;'",

    "Loading Feature | Loader with API data" => "loading.js",

    "Static Assets" => "js, css files",

    "How to make Production Build" => "2 type ===> production and development || npm run build",

    "Export Static HTML Page with Build" => "const nextConfig = { output : 'export' } || npm run build",

    "Static Site Generation" => "For create static page on the basis of params id || export async function generateStaticParams(){ }",

    "Redirection" => "import {redirect} from next/navigation || redirect('/home') || Or code in next.config file",

    "Environment variables" => "process.env || process.env.NODE_ENV || development mode ===> npm run dev || npm start",

    "API Routes" => 'api/hello/route.js || export function GET(Response){ return NextResponse.json({name:"mani"},{status:200}) }',

    "GET API" => 'api/[hello]/route.js || export function GET(Response){ return NextResponse.json({name:"mani"},{status:200}) }',

    "Call Next js API which create in API routes" => "No need...",

    "Make API with Post Method" => "function ASYNC POST(request){ let payload = await request.json() }",

    "Integrate Post API" => "No need...",

    "Make PUT API" => "function ASYNC PUT(request,id){ let payload = await request.json() }",

    "Integrate PUT" => "No need...",

    "Make DELETE API" => "function ASYNC DELETE(request,id){ return NextResponse.json(result:{name:'mani'} }",

    "Integrate Delete API" => "No need...",

    "Catch all api routes" => "[...folder-name]",

    "How to use MongoDB" => "Online mongo connection",

    "Connect MongoDB" => "Create .env.local file in root || src/lib/db.js {username,password} = env.process || install mongoose || mongoose.connect('db.js') || lib/model/product.js code like nodejs model || mongoose.model.products || mongoose.model('colection-name',schema)",
    
    "POST API with MongoDB" => "function ASYNC POST(request,id){ }",

    "Integrate POST API with MongoDB" => "No need...",

    "Get API with MongoDB" => "function ASYNC POST(request,id){ } || .find()",

    "PUT API with MongoDB" => "No need... || Product.findOneAndUpdate({_id:productId},payload)",

    "Populate Form data with MongoDB" => "No need...",

    "Delete API and UI MongoDB" => "Product.deleteOne({_id:productId})",

    "Upload Image" => "e.target.files?.[0] || await req.formData()",

    "Deploy next.js project on Vercel" => "View video...",

    // "what is redux ToolKit" => "No need",

    // "Redux Architecture" => "No need",

    // "Redux Install" => "npm i @reduxjs/toolkit react-redux || store data after refresh use redux persist",

    // "Folder Structure, Store & Provider" => "redux ===> provider.js, slice.js, store.js",

    // "Component for Redux" => "",

    // "Slice in Redux Tool Kit" => "",

    // "Store data in Redux" => "",

    // "Redux dev tools" => "",

    // "Get Data From Redux Store" => "",

    // "Remove Data From Redux Store" => ""





];




include('bottom.php');


echo "<a href='https://mentorcruise.com/questions/nextjs/'>https://mentorcruise.com/questions/nextjs/</a>";