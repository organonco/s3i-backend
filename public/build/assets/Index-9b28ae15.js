import{_ as o}from"./MainLayout-32043a28.js";import{_ as n}from"./DataTable-90b78608.js";import{C as _}from"./CenterSheet-b74b5586.js";import{r as l,o as d,f as i,w as t,a as e}from"./app-4b960826.js";import"./ConfirmationDialog-08a804e4.js";const c={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name_ar"},{title:"رقم الهاتف",align:"start",key:"phone"}]}}},w=Object.assign(c,{__name:"Index",props:{students:Object},setup(a){return(s,m)=>{const r=l("v-row");return d(),i(o,{title:"الطلاب"},{default:t(()=>[e(_,{cols:"12"},{default:t(()=>[e(r,{class:"pt-5"},{default:t(()=>[e(n,{uneditable:"",showable:"",headers:s.headers,data:a.students.data,actions_route:"student"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{w as default};
