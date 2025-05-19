import { jsxs, Fragment, jsx } from "react/jsx-runtime";
import { Head } from "@inertiajs/react";
function Welcome() {
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Home Page" }),
    /* @__PURE__ */ jsx("h1", { children: "Home Page" })
  ] });
}
export {
  Welcome as default
};
