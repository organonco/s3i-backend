import{_ as s}from"./MainLayout-a5480158.js";import{_ as o}from"./DataTable-ab386539.js";import{o as n,f as i,w as a,a as t}from"./app-12eef3ba.js";import{C as l}from"./CreateButton-22037cf8.js";import{C as _}from"./CenterSheet-2cd3dd98.js";import"./ConfirmationDialog-439535ad.js";const u={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"تاريخ الصلاحية",align:"start",key:"expires_at"},{title:"الدورات",align:"start",key:"courses"},{title:"الوسوم",align:"start",key:"tags"},{title:"عدد الأكواد",align:"start",key:"number_of_tokens"},{title:"عدد الأكواد المستعملة",align:"start",key:"number_of_used_tokens"}]}}},g=Object.assign(u,{__name:"Index",props:{batches:Array},setup(r){return(e,c)=>(n(),i(s,{title:"الأكواد"},{default:a(()=>[t(l,{link:e.route("course_token.create")},null,8,["link"]),t(_,{cols:"12"},{default:a(()=>[t(o,{headers:e.headers,data:r.batches.data,actions_route:"course_token",uneditable:"",showable:""},null,8,["headers","data"])]),_:1})]),_:1}))}});export{g as default};