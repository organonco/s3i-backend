import{_ as s}from"./MainLayout-91867d8c.js";import{_ as n}from"./DataTable-cfa6131c.js";import{C as l}from"./CreateButton-4a0785d9.js";import{C as _}from"./CenterSheet-c3d1feb1.js";import{r as i,o as c,f as d,w as t,a as e}from"./app-dddcea2c.js";import"./ConfirmationDialog-0cfbb6c7.js";const m={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name"}]}}},w=Object.assign(m,{__name:"Index",props:{education_levels:Array},setup(r){return(a,u)=>{const o=i("v-row");return c(),d(s,{title:"المستويات الدراسية"},{default:t(()=>[e(l,{link:a.route("education_level.create")},null,8,["link"]),e(_,{cols:"12"},{default:t(()=>[e(o,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.education_levels.data,actions_route:"education_level"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{w as default};