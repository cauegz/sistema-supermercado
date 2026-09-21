import { Button } from "@/components/ui/button";
import { 
  Card, 
  CardHeader, 
  CardTitle, 
  CardDescription, 
  CardContent, 
  CardFooter 
} from "@/components/ui/card";
import { Input } from "@/components/ui/input";

function LoginPage() {
    return ( 
        <>
            <Card className="mx-auto w-2xl">
                <CardHeader>
                    <h3>Entre na sua conta </h3>
                </CardHeader>
            </Card>
        </>
    );
}

export default LoginPage;