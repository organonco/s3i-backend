import{_ as t}from"./MainLayout-14f73f89.js";import{S as l}from"./SimpleFormSheet-541a6607.js";import{r as n,o as d,f as u,w as m,a,T as f}from"./app-bdcf9ddf.js";import"./CenterSheet-c32fda75.js";const i={data:function(){return{form:f({username:this.teacher.data.username,name:this.teacher.data.name,password:""})}},methods:{submit:function(){this.form.put(route("teacher.update",this.teacher.data.id))}}},h=Object.assign(i,{__name:"Edit",props:{teacher:Object},setup(p){return(e,r)=>{const s=n("v-text-field");return d(),u(t,{title:"تعديل المدرب"},{default:m(()=>[a(l,{onSave:e.submit},{default:m(()=>[a(s,{label:"اسم المدرب",variant:"solo",modelValue:e.form.name,"onUpdate:modelValue":r[0]||(r[0]=o=>e.form.name=o),"error-messages":e.form.errors.name},null,8,["modelValue","error-messages"]),a(s,{label:"اسم المستخدم",variant:"solo",modelValue:e.form.username,"onUpdate:modelValue":r[1]||(r[1]=o=>e.form.username=o),"error-messages":e.form.errors.username},null,8,["modelValue","error-messages"]),a(s,{label:"كلمة المرور",variant:"solo",modelValue:e.form.password,"onUpdate:modelValue":r[2]||(r[2]=o=>e.form.password=o),"error-messages":e.form.errors.password,type:"password"},null,8,["modelValue","error-messages"])]),_:1},8,["onSave"])]),_:1})}}});export{h as default};
