PROGRAM SarahRevere(INPUT, OUTPUT);
USES 
  DOS;
VAR
  Query: STRING;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  Query := GetEnv('QUERY_STRING');
  IF Query = 'lanterns=1' 
  THEN
    WRITELN('¬раг придЄт по суше!')
  ELSE
    IF Query = 'lanterns=2' 
    THEN
      WRITELN('¬раг придЄт по морю!')
    ELSE
      WRITELN('¬раг не придЄт')
END.
