import{_ as o}from"./MainLayout-655513cf.js";import{_ as n}from"./DataTable-91330396.js";import{r as i,o as l,f as c,w as t,a as e}from"./app-0d462adf.js";import{C as _}from"./CreateButton-bb9fcc9f.js";import{C as m}from"./CenterSheet-bc256abf.js";import"./ConfirmationDialog-6ef21e0d.js";const d={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"اسم المستخدم",align:"start",key:"username"},{title:"الاسم",align:"start",key:"name"},{title:"التخصص",align:"start",key:"education"}]}}},y=Object.assign(d,{__name:"Index",props:{teachers:Array},setup(r){return(a,u)=>{const s=i("v-row");return l(),c(o,{title:"المدربين"},{default:t(()=>[e(_,{link:a.route("teacher.create")},null,8,["link"]),e(m,{cols:"12"},{default:t(()=>[e(s,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.teachers.data,actions_route:"teacher"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{y as default};
