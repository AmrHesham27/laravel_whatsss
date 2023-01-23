import React from "react";
import { createRoot } from "react-dom/client";

// components
import PageHeader from "./components/pageHeader";
import PageBody from "./components/pageBody";
import SendToWhatsapp from "./components/sendToWhatsapp";
import ResponsiveCart from "./components/responsiveCart";
import ModalCart from "./components/modalCart";

// redux
import { Provider } from "react-redux";
import reduxStore from "./redux/store";

export default function App({ store }) {
    localStorage.setItem("color_1", store["color_1"]);
    localStorage.setItem("color_2", store["color_2"]);
    localStorage.setItem("currency", store["currency"]);
    localStorage.setItem("whatsapp", store["whatsapp"]);
    localStorage.setItem("dinIn", store["dinIn"]);
    localStorage.setItem("pickUp", store["pickUp"]);
    localStorage.setItem("delivery", store["delivery"]);

    return (
        <Provider store={reduxStore}>
            <PageHeader image={store["logo"]} />
            <div className="page-container">
                <PageBody store={store} />

                <ModalCart />
            </div>
            <ResponsiveCart />
            <SendToWhatsapp
                dinIn={store["dinIn"]}
                pickUp={store["pickUp"]}
                delivery={store["delivery"]}
                places={store["places"]}
            />
        </Provider>
    );
}

if (document.getElementById("root")) {
    var data = document.getElementById("root").getAttribute("data");
    createRoot(document.getElementById("root")).render(
        <App store={JSON.parse(data)} />
    );
}
