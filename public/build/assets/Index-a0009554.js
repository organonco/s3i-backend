import{_ as s}from"./MainLayout-632931fa.js";import{_ as n}from"./DataTable-b2b2623f.js";import{r as i,o as c,f as l,w as t,a as e}from"./app-ae7d8840.js";import{C as _}from"./CreateButton-d20d82cc.js";import{C as m}from"./CenterSheet-09e47e7a.js";import"./ConfirmationDialog-07bffdd8.js";const d={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name"}]}}},y=Object.assign(d,{__name:"Index",props:{categories:Array},setup(r){return(a,f)=>{const o=i("v-row");return c(),l(s,{title:"أقسام الكورسات"},{default:t(()=>[e(_,{link:a.route("category.create")},null,8,["link"]),e(m,{cols:"12"},{default:t(()=>[e(o,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.categories.data,actions_route:"category"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{y as default};
