import{_ as v}from"./CenterSheet-81373a03.js";import{r as e,o as p,f as V,w as t,a as o,e as C,t as h,b as s}from"./app-2322b5df.js";const x={name:"ConfirmationDialog",props:["modelValue","title"],emits:["update:modelValue","confirm"],methods:{close:function(){this.value=!1},confirm:function(){this.$emit("confirm"),this.value=!1}},computed:{value:{get(){return this.modelValue},set(n){this.$emit("update:modelValue",n)}}}},g={class:"ma-4"};function k(n,c,i,w,b,a){const r=e("v-card-title"),d=e("v-divider"),l=e("v-btn"),_=e("v-card-actions"),m=e("v-card"),u=e("v-dialog");return p(),V(u,{modelValue:a.value,"onUpdate:modelValue":c[0]||(c[0]=f=>a.value=f),persistent:"",width:"20%"},{default:t(()=>[o(m,{class:"text-center"},{default:t(()=>[o(r,null,{default:t(()=>[C("div",g,h(i.title),1)]),_:1}),o(d),o(_,{class:"justify-space-between"},{default:t(()=>[o(l,{variant:"text",onClick:a.confirm,color:"warning"},{default:t(()=>[s("نعم")]),_:1},8,["onClick"]),o(l,{variant:"text",onClick:a.close,color:"success"},{default:t(()=>[s("لا")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["modelValue"])}const N=v(x,[["render",k]]);export{N as C};
