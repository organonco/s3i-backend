import{r as i,o as r,f as s,w as a,a as n,u as h,q as f,b as u,h as c,T as b}from"./app-ae7d8840.js";import{C as _}from"./ConfirmationDialog-07bffdd8.js";const p={data(){return(this.showable||!this.uneditable)&&this.headers.push({title:"",align:"end",key:"actions"}),{itemsPerPage:25,search:"",dialogs:{destroy:{active:!1,id:null}}}},methods:{activateDestroyDialog:function(e){this.dialogs.destroy.active=!0,this.dialogs.destroy.id=e},confirmDestroyDialog:function(){b({}).delete(route(this.actions_route+".destroy",{[this.actions_route]:this.dialogs.destroy.id}))}}},k=Object.assign(p,{__name:"DataTable",props:{headers:{type:Array},data:{type:Array},actions_route:{type:String},uneditable:{type:Boolean},showable:{type:Boolean}},setup(e){return(t,l)=>{const y=i("v-text-field"),m=i("v-row"),d=i("v-btn"),v=i("v-data-table-virtual"),g=i("v-container");return r(),s(g,null,{default:a(()=>[n(_,{modelValue:t.dialogs.destroy.active,"onUpdate:modelValue":l[0]||(l[0]=o=>t.dialogs.destroy.active=o),title:"تأكيد الحذف",onConfirm:t.confirmDestroyDialog},null,8,["modelValue","onConfirm"]),n(m,null,{default:a(()=>[n(y,{modelValue:t.search,"onUpdate:modelValue":l[1]||(l[1]=o=>t.search=o),"append-inner-icon":"mdi-magnify",label:"البحث","single-line":"","hide-details":""},null,8,["modelValue"])]),_:1}),n(m,null,{default:a(()=>[n(v,{headers:e.headers,items:e.data,search:t.search,"item-value":"name",class:"elevation-1"},{"item.actions":a(({item:o})=>[e.uneditable?c("",!0):(r(),s(h(f),{key:0,as:"button",href:t.route(e.actions_route+".edit",{[e.actions_route]:o.columns.id}),method:"get",class:"underline"},{default:a(()=>[n(d,{"prepend-icon":"mdi-pencil",color:"primary",variant:"text"},{default:a(()=>[u(" تعديل ")]),_:1})]),_:2},1032,["href"])),e.uneditable?c("",!0):(r(),s(d,{key:1,"prepend-icon":"mdi-delete",onClick:D=>t.activateDestroyDialog(o.columns.id),color:"error",variant:"text"},{default:a(()=>[u(" حذف ")]),_:2},1032,["onClick"])),e.showable?(r(),s(h(f),{key:2,as:"button",href:t.route(e.actions_route+".show",{[e.actions_route]:o.columns.id}),method:"get",class:"underline"},{default:a(()=>[n(d,{"prepend-icon":"mdi-eye",color:"secondary",variant:"text"},{default:a(()=>[u(" عرض ")]),_:1})]),_:2},1032,["href"])):c("",!0)]),_:1},8,["headers","items","search"])]),_:1})]),_:1})}}});export{k as _};
