import{_ as o}from"./MainLayout-62ccb136.js";import{_ as n}from"./DataTable-24f1709d.js";import{C as i}from"./CenterSheet-bc81e101.js";import{C as l}from"./CreateButton-57d3a846.js";import{r as c,o as _,f as m,w as t,a as e}from"./app-e476da3f.js";import"./ConfirmationDialog-57a7f075.js";const u={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"اسم الدورة",align:"start",key:"name"},{title:"سعر الدورة",align:"start",key:"price"}]}}},w=Object.assign(u,{__name:"Index",props:{courses:Array},setup(r){return(a,d)=>{const s=c("v-row");return _(),m(o,{title:"الدورات"},{default:t(()=>[e(l,{link:a.route("course.create")},null,8,["link"]),e(i,{cols:"12"},{default:t(()=>[e(s,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.courses.data,actions_route:"course"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{w as default};