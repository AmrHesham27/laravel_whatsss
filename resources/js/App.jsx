import React from "react";
import { createRoot } from "react-dom/client";

// components
import {
    PageHeader,
    PageBody,
    SendToWhatsapp,
    ResponsiveCart,
    ModalCart,
    Footer
} from "./components/index";

// redux
import { Provider } from "react-redux";
import reduxStore from "./redux/store";

// bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';

export default function App({ store }) {
    localStorage.setItem("color_1", store["color_1"]);
    localStorage.setItem("color_2", store["color_2"]);
    localStorage.setItem("currency", store["currency"]);
    localStorage.setItem("whatsapp", store["whatsapp"]);
    localStorage.setItem("dinIn", store["dinIn"]);
    localStorage.setItem("pickUp", store["pickUp"]);
    localStorage.setItem("delivery", store["delivery"]);
    localStorage.setItem("displayCards", store["displayCards"]);
    localStorage.setItem("name", store["name"]);
    localStorage.setItem("start_time", store["start_time"]);
    localStorage.setItem("end_time", store["end_time"]);

    return (
        <Provider store={reduxStore}>
            <PageHeader store={store} />
            <div className="page-container">
                <PageBody store={store} />
                <ModalCart />
            </div>
            <ResponsiveCart />
            <SendToWhatsapp places={store["places"]} store_id={store['id']} />
            <Footer store={store} />
        </Provider>
    );
}

if (document.getElementById("root")) {
    var data = document.getElementById("root").getAttribute("data");
    createRoot(document.getElementById("root")).render(
        <App store={JSON.parse(data)} />
    );
}
