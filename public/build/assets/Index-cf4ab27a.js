import{_ as s}from"./MainLayout-f8f94285.js";import{_ as n}from"./DataTable-f1cdf25f.js";import{C as c}from"./CenterSheet-4d0efea4.js";import{C as l}from"./CreateButton-bbeeb758.js";import{r as _,o as i,f as m,w as t,a as e}from"./app-2855b29f.js";import"./ConfirmationDialog-3250e277.js";const u={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"اسم الكورس",align:"start",key:"name"}]}}},g=Object.assign(u,{__name:"Index",props:{courses:Array},setup(r){return(a,d)=>{const o=_("v-row");return i(),m(s,{title:"الكورسات"},{default:t(()=>[e(l,{link:a.route("course.create")},null,8,["link"]),e(c,{cols:"12"},{default:t(()=>[e(o,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.courses.data,actions_route:"course"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{g as default};
