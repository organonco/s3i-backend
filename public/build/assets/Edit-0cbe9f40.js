import{_ as m}from"./MainLayout-91867d8c.js";import{S as l}from"./SimpleFormSheet-d5b651cf.js";import{r as n,o as d,f as p,w as t,a as s,T as u}from"./app-dddcea2c.js";import"./CenterSheet-c3d1feb1.js";const f={data:function(){return{form:u({current_password:"",password:"",password_confirmation:""})}},methods:{submit:function(){this.form.put(route("password.update"))}}},g=Object.assign(f,{__name:"Edit",setup(i){return(o,r)=>{const a=n("v-text-field");return d(),p(m,{title:"تغيير كلمة المرور"},{default:t(()=>[s(l,{onSave:o.submit},{default:t(()=>[s(a,{label:"كلمة المرور الحالية",variant:"solo",modelValue:o.form.current_password,"onUpdate:modelValue":r[0]||(r[0]=e=>o.form.current_password=e),"error-messages":o.form.errors.current_password,type:"password"},null,8,["modelValue","error-messages"]),s(a,{label:"كلمة المرور الجديدة",variant:"solo",modelValue:o.form.password,"onUpdate:modelValue":r[1]||(r[1]=e=>o.form.password=e),"error-messages":o.form.errors.password,type:"password"},null,8,["modelValue","error-messages"]),s(a,{label:"إعادة كلمة المرور الجديدة",variant:"solo",modelValue:o.form.password_confirmation,"onUpdate:modelValue":r[2]||(r[2]=e=>o.form.password_confirmation=e),"error-messages":o.form.errors.password_confirmation,type:"password"},null,8,["modelValue","error-messages"])]),_:1},8,["onSave"])]),_:1})}}});export{g as default};