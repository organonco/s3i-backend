import{_ as s}from"./MainLayout-f8f94285.js";import{_ as n}from"./DataTable-f1cdf25f.js";import{r as i,o as c,f as l,w as t,a as e}from"./app-2855b29f.js";import{C as _}from"./CreateButton-bbeeb758.js";import{C as m}from"./CenterSheet-4d0efea4.js";import"./ConfirmationDialog-3250e277.js";const d={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name"}]}}},y=Object.assign(d,{__name:"Index",props:{categories:Array},setup(r){return(a,f)=>{const o=i("v-row");return c(),l(s,{title:"أقسام الكورسات"},{default:t(()=>[e(_,{link:a.route("category.create")},null,8,["link"]),e(m,{cols:"12"},{default:t(()=>[e(o,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.categories.data,actions_route:"category"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{y as default};