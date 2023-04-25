import { BrowserRouter, Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import More from "./pages/More";
import Contact from "./pages/Contact";

function RoutesApp() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/sobre" element={<More />} />
        <Route path="/contato" element={<Contact />} />
      </Routes>
    </BrowserRouter>
  );
}
export default RoutesApp;
