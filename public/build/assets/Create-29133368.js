import{_ as f}from"./MainLayout-14f73f89.js";import{S as c}from"./SimpleFormSheet-541a6607.js";import{r as a,o as _,f as b,w as s,a as l,b as n,e as V,T as v}from"./app-bdcf9ddf.js";import"./CenterSheet-c32fda75.js";const y=V("kbd",null," Enter ",-1),g={data:function(){return{search:null,form:v({courses:[],expiry_date:"",count:"",tags:[]})}},methods:{submit:function(){this.form.post(route("course_token.store"))}}},B=Object.assign(g,{__name:"Create",props:{courses:Array,tags:Array},setup(m){return(e,o)=>{const u=a("v-autocomplete"),i=a("v-list-item-title"),d=a("v-list-item"),p=a("v-combobox"),r=a("v-text-field");return _(),b(f,{title:"مجموعة أكواد جديدة"},{default:s(()=>[l(c,{cols:"6",onSave:e.submit},{default:s(()=>[l(u,{modelValue:e.form.courses,"onUpdate:modelValue":o[0]||(o[0]=t=>e.form.courses=t),label:"الدورات",items:m.courses.data,"item-value":"id","item-title":"name",chips:"","closable-chips":"",multiple:""},null,8,["modelValue","items"]),l(p,{modelValue:e.form.tags,"onUpdate:modelValue":o[1]||(o[1]=t=>e.form.tags=t),search:e.search,"onUpdate:search":o[2]||(o[2]=t=>e.search=t),items:m.tags,label:"الوسوم",multiple:"","closable-chips":"",chips:""},{"no-data":s(()=>[l(d,null,{default:s(()=>[l(i,null,{default:s(()=>[n(" لإنشاء واحدة جديدة "),y,n(" لا توجد نتائج مطابقة. اضغط على ")]),_:1})]),_:1})]),_:1},8,["modelValue","search","items"]),l(r,{modelValue:e.form.expiry_date,"onUpdate:modelValue":o[3]||(o[3]=t=>e.form.expiry_date=t),label:"تاريخ الصلاحية",type:"date"},null,8,["modelValue"]),l(r,{modelValue:e.form.count,"onUpdate:modelValue":o[4]||(o[4]=t=>e.form.count=t),label:"عدد الأكواد",type:"number"},null,8,["modelValue"])]),_:1},8,["onSave"])]),_:1})}}});export{B as default};
