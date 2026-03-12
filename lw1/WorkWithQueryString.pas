PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES 
  DOS;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  Query, ParamKey: STRING;
  PosKey, PosAmp: INTEGER;
BEGIN
  Query := GetEnv('QUERY_STRING');   
  ParamKey := Key + '=';            
  PosKey := Pos(ParamKey, Query);    
  IF PosKey = 0 
  THEN                 
    BEGIN
      GetQueryStringParameter := '';
      EXIT
    END;
  Delete(Query, 1, PosKey + Length(ParamKey) - 1);
  PosAmp := Pos('&', Query);
  IF PosAmp > 0 
  THEN
    GetQueryStringParameter := Copy(Query, 1, PosAmp - 1)
  ELSE
    GetQueryStringParameter := Query
END;

BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END.
